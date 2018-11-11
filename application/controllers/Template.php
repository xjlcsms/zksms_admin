<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/7/5
 * Time: 0:07
 */
//27000
class TemplateController extends \Base\ApplicationController
{
    private $_templateStatus = array('待审核','审核通过','审核不通过');
    private $_templateTypes = array(0=>'验证码',1=>'行业短信',2=>'营销短信');

    /**
     * 模板列表
     */
    public function indexAction(){
        $where = [];
        $status = $this->getParam('status',100,'int');
        $type = $this->getParam('type',100,'int');
        $sign = $this->getParam('sign','','string');
        $userId = $this->getParam('userId','','int');
        if($status !=100){
            $where['status'] = $status;
        }
        if($type){
            $where['classify'] = $type;
        }
        if($sign){
            $where[] = "sign like '%".$sign."%'";
        }
        if($userId){
            $where['userId'] = $userId;
        }
        $mapper = \M\Mapper\SmsTemplate::getInstance();
        $select = $mapper->select();
        $select->where($where);
        $select->order(array('createTime desc'));
        $page = $this->getParam('page', 1, 'int');
        $pagelimit = $this->getParam('pagelimit', 15, 'int');
        $pager = new \Ku\Page($select, $page, $pagelimit, $mapper->getAdapter());
        $this->assign('pager', $pager);
        $this->assign('pagelimit', $pagelimit);
        $this->assign('userId', $userId);
        $this->assign('status', $status);
        $this->assign('type', $type);
        $this->assign('sign', $sign);
        $this->assign('types',$this->_templateTypes);
        $this->assign('templateStatus',$this->_templateStatus);
    }


    /**
     * 模板审核
     * @return false
     */
    public function aduitAction(){
        $id = $this->getParam('id',0,'int');
        $audit = $this->getParam('audit','not_adopted','string');
        $reason = $this->getParam('reason','','string');
        $mapper = \M\Mapper\SmsTemplate::getInstance();
        $template = $mapper->fetch(array('id'=>$id,'status'=>0));
        if(!$template instanceof \M\SmsTemplate){
            return $this->returnData('该审核模板未找到',1000);
        }
        if($audit !='not_adopted' && $audit !='adopted' ){
            return $this->returnData('审核结果不正确',1000);
        }
        if($audit == 'not_adopted' && empty($reason)){
            return $this->returnData('请输入不通过原因',1000);
        }
        $template->setReason($reason);
        $status = $audit == 'adopted'?1:2;
        $template->setStatus($status);
        $template->setUpdateTime(date('YmdHis'));
        $res = $mapper->update($template);
        if(!$res){
            return $this->returnData('审核失败，请重试！',1000);
        }
        return $this->returnData('审核成功',1001,true);
    }

    /**获取模板内容
     * @return false
     */
    public function gainAction(){
        $mapper =\M\Mapper\SmsTemplate::getInstance();
        $tempId = $this->getParam('tempId',0,'int');
        $temp = $mapper->fetch(array('Id'=>$tempId,'status'=>1));
        if(!$temp instanceof \M\SmsTemplate){
            return $this->returnData('模板不存在或未审核',1000);
        }
        $data = $temp->toArray();
        return $this->returnData('获取成功',1001,true,$data);
    }


}