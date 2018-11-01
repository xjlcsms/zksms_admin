<?php
/**
 * Created by PhpStorm.
 * User: chendongqin
 * Date: 18-11-1
 * Time: 下午9:57
 */
namespace Business;
final class User extends \Business\BusinessAbstract
{
    use \Business\Instance;

    private $_accountType = array(1=>'code',2=>'normal',3=>'market');

    public function flow(\M\SmsUser $user , $amount ,$flow , $action){
        if(!isset($this->_accountType[$flow])){
            return $this->getMsg(1002,'参数错误');
        }
        $mapper = \M\Mapper\SmsAccount::getInstance();
        $orderMapper = \M\Mapper\SmsOrder::getInstance();
        $admin = \Business\Login::getInstance()->getCurrentUser();
        $account = \M\Mapper\SmsAccount::getInstance()->findByUserId($user->getId());
        if(!$account instanceof \M\Mapper\SmsAccount){
            $account = new \M\SmsAccount();
            $account->setUserId($user->getId());
            $mapper->insert($account);
        }
        $mapper->begin();
        $flowStr = $this->_accountType[$flow];
        if($action ==1){
            $change = $flowStr.'+'.$amount;
        }else{
            $keyStr = 'get'.ucfirst($flowStr);
            if($account->$keyStr() < $amount){
                return $this->getMsg(1004,'用户该类型的余额不足');
            }
            $change = $flowStr.'-'.$amount;
        }
        $update = array($flowStr=>$change,'updateTime'=>date('YmdHis'));
        $res = $mapper->update($update,array('userId'=>$user->getId()));
        if(!$res){
            $mapper->rollback();
            return $this->getMsg(1003,'修改账户失败');
        }
        $order = new \M\SmsOrder();
        $order->setUserId($user->getId());
        $order->setAmount($amount);
        $order->setType($action);
        $order->setCreateTime(date('YmdHis'));
        $order->setChannel($flowStr);
        $order->setActer($admin->getId());
        $res = $orderMapper->insert($order);
        if(!$res){
            $mapper->rollback();
            return $this->getMsg(1003,'添加订单失败');
        }
        $mapper->commit();
        return true;
    }

}