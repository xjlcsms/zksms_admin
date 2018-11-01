<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/10/26
 * Time: 23:07
 */
namespace Business;
final class Smser extends \Business\BusinessAbstract{
    use \Business\Instance;

    protected $_mobiles = '';
    protected $_sign = '';
    protected $_content = '';
    protected $_sendTime = '';

    /**设置发送手机号
     * @param $mobiles
     * @return $this
     */
    public function setMobiles($mobiles){
        $this->_mobiles = $mobiles;
        return $this;
    }

    /**获取手机号
     * @return string
     */
    public function getMobiles(){
        return $this->_mobiles;
    }

    /**设置签名
     * @param $sign
     * @return $this
     */
    public function setSign($sign){
        $this->_sign = $sign;
        return $this;
    }

    /**获取签名
     * @return string
     */
    public function getSign(){
        return $this->_sign;
    }
    /**设置短信内容
     * @param $content
     * @return $this
     */
    public function setContent($content){
        $this->_content = $content;
        return $this;
    }
    /**获取短信内容
     * @return string
     */
    public function getContent(){
        return $this->_content;
    }
    /**发送短信
     * @param $smser
     * @return mixed
     */
    public function send($smser){
        if(empty($this->getMobiles()) or empty($this->getContent())){
            return $this->getMsg(8000,'未设置发送的手机号或发送内容');
        }
        return $this->$smser();
    }
    /**设置发送时间
     * @param $sendTime
     * @return $this
     */
    public function setSendTime($sendTime){
        $this->_sendTime = $sendTime;
        return $this;
    }
    /**获取发送时间
     * @return string
     */
    public function getSendTime(){
        return $this->_sendTime;
    }

    /**
     * 奎展移动会员营销
     */
    public function kuizhan1(){
        $timestamp = date('YmdHis');
        $sign = md5('xjlckj3a123456'.$timestamp);
        $content = '【'.$this->getSign().'】'.$this->getContent();
        $params = array(
            'userid'=>18,'timestamp'=>$timestamp,
            'sign'=>$sign,'mobile'=>$this->getMobiles(),
            'content'=>$content,'sendTime'=>$this->getSendTime(),
            'action'=>'send','extno'=>''
        );
        $url = 'http://39.104.191.22:8888/v2sms.aspx';
        $xml =  $this->sms($url,$params);
        $res = simplexml_load_string($xml);
        $send = json_decode(json_encode($res),true);
        if(!isset($send['returnstatus'])){
            return $this->getMsg(80101,'发送失败');
        }
        if ($res->returnstatus != 'Success'){
            return $this->getMsg(80100,$send['message']);
        }
        return $send;
    }

    public function kuizhan2(){
        $timestamp = date('YmdHis');
        $sign = md5('xjlckj2a123456'.$timestamp);
        $content = '【'.$this->getSign().'】'.$this->getContent();
        $params = array(
            'userid'=>19,'timestamp'=>$timestamp,
            'sign'=>$sign,'mobile'=>$this->getMobiles(),
            'content'=>$content,'sendTime'=>$this->getSendTime(),
            'action'=>'send','extno'=>''
        );
        $url = 'http://39.104.191.22:8888/v2sms.aspx';
        $xml =  $this->sms($url,$params);
        $res = simplexml_load_string($xml);
        $send = json_decode(json_encode($res),true);
        if(!isset($send['returnstatus'])){
            return $this->getMsg(80101,'发送失败');
        }
        if ($res->returnstatus != 'Success'){
            return $this->getMsg(80100,$send['message']);
        }
        return $send;
    }


    /**发送请求
     * @param $url
     * @param array $param
     * @return array|\Ku\json|null|Object|string
     */
    public function sms($url,array $param){
        $http = new \Ku\Http();
        $http->setUrl($url);
        $http->setParam($param,true);
        $send = $http->send();
        return $send;
    }


}