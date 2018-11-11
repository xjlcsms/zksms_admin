<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/7/1
 * Time: 21:10
 */
//25000
class DataController extends \Base\ApplicationController
{

    /**
     * 获取待审核的模板数量
     * @return false
     */
    public function tempnumAction(){
        $templatesMapper = \M\Mapper\SmsTemplate::getInstance();
        $templateWhere = array('status'=>0);
        $num = (int)$templatesMapper->count($templateWhere);
        return $this->returnData('获取成功',1001,true,array('tempnum'=>$num));
    }

    /**
     * 获取待处理的任务数量
     * @return false
     */
    public function jobnumAction(){
        $mapper = \M\Mapper\SmsTask::getInstance();
        $where = array('status'=>0,'isSys'=>1);
        $num = $mapper->count($where);
        return $this->returnData('获取成功',25001,true,array('jobnum'=>$num));
    }

    /**
     * 统计当天发送的短信数据
     * @return false
     */
    public function daysendAction(){
        $mapper =  \M\Mapper\SmsTask::getInstance();
        $date = date('Ymd');
        $codeWhere = array('channel'=>'code','status'=>1,'sendTime >= '.$date.'000000','sendTime <= '.$date.'235959');
        $generalWhere = array('channel'=>'normal','status'=>1,'sendTime >= '.$date.'000000','sendTime <= '.$date.'235959');
        $marketWhere = array('channel'=>'market','status'=>1,'sendTime >= '.$date.'000000','sendTime <= '.$date.'235959');
        $codeSend = $mapper->sum('sendTotal',$codeWhere);
        $generalSend = $mapper->sum('sendTotal',$generalWhere);
        $generalSend += $codeSend;
        $marketSend = $mapper->sum('sendTotal',$marketWhere);
        $data = array('generalSend'=>$generalSend,'marketSend'=>$marketSend);
        return $this->returnData('获取成功',25002,true,$data);
    }

    /**
     * 获取当天的充值额度
     * @return false
     */
    public function dayrechargeAction(){
        $mapper = \M\Mapper\SmsOrder::getInstance();
        $date = date('Y-m-d');
        $codeWhere = array('type'=>1,'channel'=>'code','createTime >= '.$date.'000000','createTime <= '.$date.'235959');
        $generalWhere = array('type'=>1,'channel'=>'normal','createTime >= '.$date.'000000','createTime <= '.$date.'235959');
        $marketWhere = array('type'=>1,'channel'=>'market','createTime >= '.$date.'000000','createTime <= '.$date.'235959');
        $code = (float)$mapper->sum('amount',$codeWhere);
        $general = (float)$mapper->sum('amount',$generalWhere);
        $general += $code;
        $market = (float)$mapper->sum('amount',$marketWhere);
        $data = array('general'=>$general,'market'=>$market);
        return $this->returnData('获取成功',25003,true,$data);
    }

    public function gettaskAction(){
        $taskid = $this->getParam('id',0,'int');
        $mapper = \M\Mapper\SmsTask::getInstance();
        $task = $mapper->findById($taskid);
        if(!$task instanceof \M\SmsTask){
            return $this->returnData('发送任务不存在',25004);
        }
        $data = $task->toArray();
        return $this->returnData('获取成功',25005,true,$data );
    }


}