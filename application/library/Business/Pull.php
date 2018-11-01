<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/10/27
 * Time: 1:58
 */
namespace Business;
final class Pull extends \Business\BusinessAbstract
{
    use \Business\Instance;

    public function get($smser){
        return $this->$smser();
    }

    public function kuizhan1(){
        $timestamp = date('YmdHis');
        $sign = md5('xjlckj3a123456'.$timestamp);
        $params = array(
            'userid'=>18,'timestamp'=>$timestamp,'sign'=>$sign,
            'statusNum'=>4000, 'action'=>'query'
        );
        $url = 'http://39.104.191.22:8888/v2statusApi.aspx';
        $xml =  $this->sms($url,$params);
        $res = simplexml_load_string($xml);
        $send = json_decode(json_encode($res),true);
        if(isset($send['errorstatus'])){
            return $this->getMsg($send['errorstatus']['error'],$send['errorstatus']['remark']);
        }
        return $send;
    }

    public function kuizhan2(){
        $timestamp = date('YmdHis');
        $sign = md5('xjlckj2a123456'.$timestamp);
        $params = array(
            'userid'=>19,'timestamp'=>$timestamp,'sign'=>$sign,
            'statusNum'=>4000, 'action'=>'query'
        );
        $url = 'http://39.104.191.22:8888/v2statusApi.aspx';
        $xml =  $this->sms($url,$params);
        $res = simplexml_load_string($xml);
        $send = json_decode(json_encode($res),true);
        if(isset($send['errorstatus'])){
            return $this->getMsg($send['errorstatus']['error'],$send['errorstatus']['remark']);
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