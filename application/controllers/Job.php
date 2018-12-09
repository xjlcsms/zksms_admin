<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/7/7
 * Time: 20:57
 */
class JobController extends Base\ApplicationController{
    private $_sendTypes = array(0=>'验证码',1=>'行业短信',2=>'营销短信');
    /**
     * 待处理任务列表
     */
    public function indexAction(){
        $where = ['status'=>0,'isSys'=>1];
        $uwhere = [];
        $username = $this->getParam('username','','string');
        $company = $this->getParam('company','','string');
        if(!empty($username)){
            $uwhere[] = "acount like '%".$username."%'";
        }
        if(!empty($company)){
            $uwhere[] = "name like '%".$company."%'";
        }
        if(!empty($uwhere)){
            $userids = \M\Mapper\SmsUser::getInstance()->fetchAll($uwhere,null,0,0,array('id'),false);
            $ids = [];
            foreach ($userids as $userid){
                $ids = $userid['id'];
            }
            if(empty($ids)){
                $where[] = '1=2';
            }else{
                $where[] = 'userId in('.implode(',',$ids).')';
            }
        }
        $mapper = \M\Mapper\SmsTask::getInstance();
        $select = $mapper->select();
        $select->where($where);
        $select->order(array('createTime desc'));
        $page = $this->getParam('page', 1, 'int');
        $pagelimit = $this->getParam('pagelimit', 15, 'int');
        $pager = new \Ku\Page($select, $page, $pagelimit, $mapper->getAdapter());
        $this->assign('pager', $pager);
        $this->assign('pagelimit', $pagelimit);
        $this->assign('username',$username);
        $this->assign('company',$company);
        $this->assign('sendTypes',$this->_sendTypes);
    }

    /**
     * 处理记录
     */
    public function dealAction(){
        $mapper = \M\Mapper\SmsTask::getInstance();
        $where = array();
        $uwhere = [];
        $userId = $this->getParam('userid','','int');
        if(!empty($userId)){
            $where['userId'] = $userId;
        }
        $this->assign('userid',$userId);
        $company = $this->getParam('company','','string');
        if(!empty($company)){
            $uwhere[] = "name like '%".$company."%'";
        }
        if(!empty($uwhere)){
            $userids = \M\Mapper\SmsUser::getInstance()->fetchAll($uwhere,null,0,0,array('id'),false);
            $ids = [];
            foreach ($userids as $userid){
                $ids = $userid['id'];
            }
            if(empty($ids)){
                $where[] = '1=2';
            }else{
                $where[] = 'userId in('.implode(',',$ids).')';
            }
        }
        $time = $this->getParam('time','','string');
        if(!empty($time)){
            $timeArr = explode('-',$time);
            $begin = date('Ymd',strtotime(trim($timeArr[0])));
            $end = date('Ymd',strtotime(trim($timeArr[1])));
            $where[] = 'createTime >='.$begin.'000000 and createTime <= '.$end.'235959';
        }
        $type = $this->getParam('type','','string');
        if(!empty($type)){
            $where['channel'] = $type;
        }
        $sign = $this->getParam('sign','','string');
        if(!empty($sign)){
            $where[] = "sign like'%".$sign."%'";
        }
        $content = $this->getParam('content','','string');
        if(!empty($content)){
            $where[] = "content like'%".$sign."%'";
        }
        $select = $mapper->select();
        $select->where($where);
        $select->order(array('id desc'));
        $page = $this->getParam('page', 1, 'int');
        $pagelimit = $this->getParam('pagelimit', 15, 'int');
        $pager = new \Ku\Page($select, $page, $pagelimit, $mapper->getAdapter());
        $this->assign('pager', $pager);
        $this->assign('pagelimit', $pagelimit);
        $this->assign('time',$time);
        $this->assign('company',$company);
        $this->assign('sign',$sign);
        $this->assign('type',$type);
        $this->assign('content',$content);
        $this->assign('sendTypes',$this->_sendTypes);
        $users = \M\Mapper\SmsUser::getInstance()->fetchAll(array('isdel'=>0),array('id asc'),0,0,array('id','account'));
        $userData = [];
        foreach ($users as $user){
            $userData[$user->getId()] = $user->getAccount();
        }
        $this->assign('users',$userData);
    }

    /**
     * 发送界面
     * @throws ErrorException
     */
    public function sendAction(){
        $taskid = $this->getParam('id',1,'int');
        $mapper = \M\Mapper\SmsTask::getInstance();
        $task = $mapper->fetch(array('id'=>$taskid,'status'=>0,'type'=>2));
        if(!$task instanceof \M\SmsTask){
            throw new ErrorException('发送任务不存在');
        }
        $this->assign('task',$task->toArray());
        $this->assign('sendTypes',\M\Mapper\SmsTask::$sendTypes);
    }


    /**
     * 发送短信
     * @return false
     * @throws Exception
     * @throws \PHPExcel\PHPExcel\Reader_Exception
     */
    public function smsAction(){
        $type = $this->getParam('type',0,'int');
        $smstype = $this->getParam('smstype',0,'int');
        $taskid = $this->getParam('taskid',0,'int');
        $content = $this->getParam('content','','string');
        $task = \M\Mapper\SmsTask::getInstance()->findById($taskid);
        if(!$task instanceof \M\SmsTask){
            return $this->returnData('发送任务不存在',29204);
        }

        $user = \M\Mapper\SmsUser::getInstance()->findById($task->getUserId());
        if(!$user instanceof \M\SmsUser){
            return $this->returnData('发送任务用户不存在',1000);
        }
        $smsBusiness = \Business\Smsaction::getInstance();
        if($smstype == 1){
            $smsfile = $this->getParam('smsfile','','string');
            if(!file_exists(APPLICATION_PATH.'/public/uploads/sms/'.$smsfile) || empty($smsfile)){
                return $this->returnData('发送文件不存在',1000);
            }
            $mobiles = $smsBusiness->importMobiles($smsfile);
        }else{
            $request = $this->request();
            $mobilesStr = $request->get('mobiles','');
            $mobiles = explode(',',$mobilesStr);
        }
        if(empty($mobiles)){
            return $this->returnData('没有获取到有效的手机号',1000);
        }
        $strlen = mb_strlen($content);
        if($strlen>500){
            return $this->returnData('消息长度不能超过500字',1000);
        }
        //发送的总数
        $totalfee = $smsBusiness->totalFee($mobiles,$content);
        $virefy = $smsBusiness->virefy($user,$content,$type,$totalfee);
        if(!$virefy){
            $message = $smsBusiness->getMessage();
            return $this->returnData($message);
        }
        $mobiles = $smsBusiness->divideMobiles($mobiles);
        $smsMapper = \M\Mapper\SmsQueue::getInstance();
        $smsMapper->begin();
        $model = new \M\SmsQueue();
        $model->setTaskId($taskid);
        foreach ($mobiles as $mobile){
            $data = $smsBusiness->trueMobiles($user,$mobile);
            $fail = empty($data['fail'])?'':implode(',',$data['fail']);
            $model->setFailMobiles($fail);
            $true = implode(',',$data['true']);
            $model->setSendMobiles(empty($true)?'':$true);
            $res = $smsMapper->insert($model);
            if($res === false){
                $smsMapper->rollback();
                return $this->returnData('发送失败',29200);
            }
        }
        if($task->getStatus() == 0){
            $task->setStatus(1);
            \M\Mapper\SmsTask::getInstance()->update($task);
        }
        $smsMapper->commit();
        return $this->returnData('发送成功',29201,true);
    }



    /**批量发送文件上传
     * @return false
     * @throws Exception
     * @throws \PHPExcel\PHPExcel\Reader_Exception
     */
    public function smsfileAction(){
        $fileInfo = $_FILES['smsfile'];
        $taskid = $this->getParam('taskid',0,'int');
        $task = \M\Mapper\SmsTask::getInstance()->findById($taskid);
        if(!$task instanceof \M\SmsTask){
            return $this->returnData('发送任务不存在',291004);
        }
        if (empty($fileInfo)) {
            return $this->returnData('没有文件上传！', 29100);
        }
        $name=explode('.',$fileInfo['name']);
        $lastName=end($name);
        if(strtolower($lastName) != 'xls' and strtolower($lastName) !='xlsx' and strtolower($lastName) !='xlsb'){
            return $this->returnData('上传文件格式必须为/xls/xlsx/xlsb等文件！', 28101);
        }
        if ($fileInfo['error'] > 0) {
            $errors = array(1=>'文件大小超过了PHP.ini中的文件限制！',2=>'文件大小超过了浏览器限制！',3=>'文件部分被上传！','没有找到要上传的文件！',4=>'服务器临时文件夹丢失，请重新上传！',5=>'文件写入到临时文件夹出错！');
            $error = isset($errors[$fileInfo['error']])?$errors[$fileInfo['error']]:'未知错误！';
            return $this->returnData($error, 29102);
        }
        $d = date("YmdHis");
        $randNum = rand((int)50000000, (int)10000000000);
        $filesname = $d . $randNum . '_'.$taskid.'.' .$lastName;
        $dir = APPLICATION_PATH . '/public/uploads/sms/';
        if(!file_exists($dir)){
            \Ku\Tool::makeDir($dir);
        }
        if (!copy($fileInfo['tmp_name'], $dir. $filesname)) {
            return $this->returnData('文件上传失败！', 29103);
        }
        try{
            $read = \PHPExcel\IOFactory::createReader('Excel2007');
            $obj = $read->load($dir. $filesname);
            $dataArray =$obj->getActiveSheet()->toArray();
            $mobiles = [];
            $fail = 0;
            unset($dataArray[0]);
            foreach ($dataArray as $key=> $item){
                if(!\Ku\Verify::isMobile($item[0])){
                    $fail++;
                    continue;
                }
                $mobiles[] = $item[0];
            }
            $isMobile = count($mobiles);
            $mobiles = array_unique($mobiles);
            $true = count($mobiles);
            $key = md5($filesname);
            $redis = $this->getRedis();
            $redis->set($key,json_encode($mobiles),3600*2);
            return $this->returnData('文件上传成功！', 29101,true,array('filename'=>$filesname,'total'=>$fail+$isMobile,'true'=>$true,'repeat'=>$isMobile-$true,'fail'=>$fail));
        }catch (\ErrorException $errorException){
            return $this->returnData('读取文件错误',29105);
        }
    }


    /**文件删除
     * @return false
     * @throws Exception
     */
    public function delsmsfAction(){
        $fileName = $this->getParam('fileName','','string');
        $dir = APPLICATION_PATH.'/public/uploads/sms/'.$fileName;
        if(file_exists($dir)){
            @unlink($dir);
        }
        $redis = $this->getRedis();
        $redis->del(md5($fileName));
        return $this->returnData('删除成功',29011,true);
    }

    /**
     * 下载批量短信模板
     */
    public function downtempAction(){
        header('Content-Type:application/xlsx');
        header('Content-Disposition:attachment;filename=sms_template.xlsx');
        header('Cache-Control:max-age=0');
        readfile(APPLICATION_PATH.'/data/sms_template.xlsx');
        exit();
    }


    /**任务驳回
     * @return false
     */
    public function rejectAction(){
        $taskid = $this->getParam('taskid',0,'int');
        $mapper = \M\Mapper\SmsTask::getInstance();
        $task = $mapper->findById($taskid);
        if(!$task instanceof \M\SmsTask){
            return $this->returnData('处理的任务不存在',29400);
        }
        $task->setStatus(4);
        $task->setUpdateTime(date('YmdHis'));
        $res = $mapper->update($task);
        if(!$res){
            return $this->returnData('驳回任务失败，请重试',29402);
        }
        return $this->returnData('处理成功',29401,true);
    }

    /**
     * 发送记录
     */
    public function recordAction(){
        $mapper = \M\Mapper\SmsRecord::getInstance();
        $where =array();
        $taskId = $this->getParam('taskId',0,'int');
        $this->assign('taskId',$taskId);
        $mobile = $this->getParam('mobile','','string');
        $userId = $this->getParam('userId','','int');
        $status = $this->getParam('status',100,'int');
        $report_status = $this->getParam('report_status',100,'int');
        if(!empty($mobile)){
            $where['mobile'] = $mobile;
        }
        $this->assign('mobile',$mobile);
        if(!empty($userId)){
            $where['userId'] = $userId;
        }
        $this->assign('userId',$userId);
        if ($status != 100){
            $where['status'] = $status;
        }
        $this->assign('status',$status);
        if ($report_status != 100){
            $where['report_status'] = $report_status;
        }
        $this->assign('report_status',$report_status);
        $type = $this->getParam('type','','string');
        if($type){
            $where['channel'] = $type;
        }
        $this->assign('type',$type);
        $select = $mapper->select();
        $select->where($where);
        $select->order(array('id desc'));
        $page = $this->getParam('page', 1, 'int');
        $pagelimit = $this->getParam('pagelimit', 15, 'int');
        $pager = new \Ku\Page($select, $page, $pagelimit, $mapper->getAdapter());
        $this->assign('pager', $pager);
        $this->assign('pagelimit', $pagelimit);
        $this->assign('types', \M\Mapper\SmsTask::$sendTypes);
        $this->assign('statusData', array('发送中','成功','失败'));
        $this->assign('reportStatus', array('发送中','已到达','未到达'));
        $users = \M\Mapper\SmsUser::getInstance()->fetchAll(array('isdel'=>0),array('id asc'),0,0,array('id','account'));
        $userData = [];
        foreach ($users as $user){
            $userData[$user->getId()] = $user->getAccount();
        }
        $this->assign('users',$userData);
    }


    /**获取短信发送信息
     * @return false
     */
    public function checknumAction(){
        $mobileStr = $this->getParam('mobiles','','string');
        $content = $this->getParam('content','','string');
        $mobiles= [];
        if(!empty($mobileStr)){
            $mobiles = explode(',',$mobileStr);
        }
        $business = \Business\Smsaction::getInstance();
        $oneFee = $business->oneFee($content);
        $total = $oneFee * count($mobiles);
        $data = array('total'=>$total,'oneFee'=>$oneFee);
        return $this->returnData('获取成功',1001,true,$data);
    }

}