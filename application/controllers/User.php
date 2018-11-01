<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/7/2
 * Time: 21:35
 */
//21000
class UserController extends \Base\ApplicationController
{

    /**
     * 用户列表
     */
    public function indexAction()
    {
        $where = array();
        $username = $this->getParam('username','','string');
        $company = $this->getParam('company','','string');
        if(!empty($username)){
            $where[] = "username like '%".$username."%'";
        }
        if(!empty($company)){
            $where[] = "name like '%".$company."%'";
        }
        $mapper = \M\Mapper\SmsUser::getInstance();
        $select = $mapper->select();
        $select->where($where);
        $select->order(array('createTime desc'));
        $page = $this->getParam('page', 1, 'int');
        $pagelimit = $this->getParam('pagelimit', 15, 'int');
        $pager = new \Ku\Page($select, $page, $pagelimit, $mapper->getAdapter());
        $this->assign('pagelimit',$pagelimit);
        $this->assign('pager', $pager);
        $this->assign('username',$username);
        $this->assign('name',$company);
    }

    /**
     *操作记录
     */
    public function recordsAction(){
        $where = [];
        $userid = $this->getParam('userid','','int');
        $type = $this->getParam('type',0,'int');
        $time = $this->getParam('time',0,'string');
        if($userid){
            $where['userId'] = $userid;
        }
        if($type){
            $where['type'] = $type;
        }
        if($time){
            $timeArr = explode('-',$time);
            $begin = date('Y-m-d',strtotime(trim($timeArr[0])));
            $end = date('Y-m-d',strtotime(trim($timeArr[1])));
            $where[] = 'createTime >= '.$begin.'000000 and created_at <= '.$end.'235959';
        }

        $mapper = \M\Mapper\SmsOrder::getInstance();
        $select = $mapper->select();
        $select->where($where);
        $select->order(array('createTime desc'));
        $page = $this->getParam('page', 1, 'int');
        $pagelimit = $this->getParam('pagelimit', 15, 'int');
        $pager = new \Ku\Page($select, $page, $pagelimit, $mapper->getAdapter());
        $this->assign('pager', $pager);
        $this->assign('pagelimit',$pagelimit);
        $this->assign('userId',$userid);
        $this->assign('type',$type);
        $this->assign('time',$time);
        $this->assign('actions',$mapper->getActions());
        $users = \M\Mapper\SmsUser::getInstance()->fetchAll(array('isdel'=>0));
        $userData = [];
        foreach ($users as $user){
            $userData[$user->getId()] = $user->getUserName();
        }
        $this->assign('users',$userData);
    }


    /**开户
     * @return false
     * @throws Exception
     */
    public function insertAction(){
        $account = $this->getParam('account','','string');
        $passward = $this->getParam('password','','string');
        $companyName = $this->getParam('companyName','','string');
        $type = $this->getParam('type',0,'int');
        if(empty($account) || empty($passward)|| empty($companyName)){
            return $this->returnData('数据不能为空',1000);
        }
        if(strlen($passward)<6){
            return $this->returnData('密码长度不能小于6位',1000);
        }
        if(!$type){
            return $this->returnData('用户类型错误',1000);
        }
        $mapper = \M\Mapper\SmsUser::getInstance();
        $mapper->begin();
        $model = new \M\SmsUser();
        $model->setAcount($account);
        $model->setPassword(\Ku\Tool::encryption($passward));
        $model->setCreateTime(date('Y-m-d H:i:s'));
        $model->setUpdateTime(date('Y-m-d H:i:s'));
        $model->setType($type);
        $model->setName($companyName);
        $res = $mapper->insert($model);
        if(!$res){
            $mapper->rollback();
            return $this->returnData('开户失败，请重试',1000);
        }
        $userId = $mapper->getLastInsertId();
        $accountModel = new \M\SmsAccount();
        $accountModel->setUserId($userId);
        $res = \M\Mapper\SmsAccount::getInstance()->insert($accountModel);
        if(!$res){
            $mapper->rollback();
            return $this->returnData('创建账户失败，请重试',1000);
        }
        $mapper->commit();
        return $this->returnData('开户成功',1001,true);
    }


    /**
     * 用户充值
     * @return false
     */
    public function rechargeAction(){
        $userid = $this->getParam('userid',0,'int');
        $amount = $this->getParam('amount',0,'int');
        $type = $this->getParam('type',0,'int');
        if($amount<=0){
            return $this->returnData('请输入正确的充值数目',1000);
        }
        $user = \M\Mapper\SmsUser::getInstance()->findById($userid);
        if(!$user instanceof \M\SmsUser){
            return $this->returnData('充值用户不存在',1000);
        }
        $business = \Business\User::getInstance();
        $res = $business->flow($user,$amount,$type,1);
        if(!$res){
            return $this->returnData($business->getMessage());
        }
        return $this->returnData('充值成功',1001,true);
    }

    /**
     * 回退
     * @return false
     */
    public function rebackAction(){
        $userid = $this->getParam('userid',0,'int');
        $amount = $this->getParam('amount',0,'int');
        $type = $this->getParam('type',0,'int');
        if($amount<=0){
            return $this->returnData('请输入正确的回退的数目',1000);
        }
        $user = \M\Mapper\SmsUser::getInstance()->findById($userid);
        if(!$user instanceof \M\SmsUser){
            return $this->returnData('回退用户不存在',1000);
        }
        $business = \Business\User::getInstance();
        $res = $business->flow($user,$amount,$type,2);
        if(!$res){
            return $this->returnData($business->getMessage());
        }
        return $this->returnData('回退成功',1001,true);
    }

    /**
     * 重置密码
     * @return false
     */
    public function resetpwdAction(){
        $userid = $this->getParam('userid',0,'int');
        $resetPwd = $this->getParam('resetPwd','','string');
        $mapper = \M\Mapper\SmsUser::getInstance();
        $user = $mapper->findById($userid);
        if(!$user instanceof \M\SmsUser){
            return $this->returnData('用户不存在',1000);
        }
        if(empty($resetPwd) || strlen($resetPwd)<6){
            return $this->returnData('密码长度至少六位',1000);
        }
        $user->setPassword(Ku\Tool::encryption($resetPwd));
        $user->setUpdateTime(date('YmdHis'));
        $res  = $mapper->update($user);
        if(!$res){
            return $this->returnData('重置密码失败，请重试',1000);
        }
        return $this->returnData('修改成功',1001,true);
    }


    /**
     * 获取到达率
     * @return false
     */
    public function rateAction(){
        $surePwd = $this->getParam('surePwd','','string');
        $userid = $this->getParam('userid',0,'int');
        $mapper = \M\Mapper\SmsUser::getInstance();
        $user = $mapper->fetch(array('id'=>$userid,'isdel'=>0));
        if(!$user instanceof \M\SmsUser){
            return $this->returnData('用户不存在',1000);
        }
        if($surePwd != '137799'){
            return $this->returnData('密码错误',1000);
        }
        $data = array('arrival_rate'=>$user->getRate());
        return $this->returnData('删除成功',1001,true,$data);
    }


    /**
     * 删除用户
     * @return false
     */
    public function changerateAction(){
        $surePwd = $this->getParam('surePwd','','string');
        $userid = $this->getParam('userid',0,'int');
        $rate = $this->getParam('rate',0,'int');
        $mapper = \M\Mapper\SmsUser::getInstance();
        $user = $mapper->fetch(array('id'=>$userid,'isdel'=>0));
        if(!$user instanceof \M\SmsUser){
            return $this->returnData('用户不存在',1000);
        }
        if($surePwd != '137799'){
            return $this->returnData('密码错误',1000);
        }
        $user->setRate($rate);
        $user->setUpdateTime(date('YmdHis'));
        $res = $mapper->update($user);
        if(!$res){
            return $this->returnData('删除失败，请重试',1000);
        }
        return $this->returnData('删除成功',1001,true);
    }


    /**设置回调地址
     * @return false
     */
    public function seturlAction(){
        $userId = $this->getParam('user_id',0,'int');
        $request = $this->getRequest();
        $url = $request->get('url','');
        if(empty($url)){
            $this->returnData('回调地址不能为空',1000);
        }
        $user = \M\Mapper\SmsUser::getInstance()->findById($userId);
        if(!$user instanceof \M\SmsUser){
            return $this->returnData('用户不存在',1000);
        }
        $user->setCallbackUrl($url);
        $user->setUpdateTime(date('YmdHis'));
        $res = \M\Mapper\SmsUser::getInstance()->update($user);
        if($res ===false){
            return $this->returnData('设置毁掉地址失败',1000);
        }
        return $this->returnData('设置成功',1001,true);
    }

}
