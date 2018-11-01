<?php

/**
 * 短信发送记录表
 * 
 * @Table Schema: zk_sms
 * @Table Name: sms_record
 */
namespace M;

class SmsRecord extends \M\ModelAbstract {

    /**
     * Params
     * 
     * @var array
     */
    protected $_params = null;

    /**
     * Id
     * 
     * Column Type: int(11)
     * auto_increment
     * PRI
     * 
     * @var int
     */
    protected $_id = null;

    /**
     * 任务ID
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_taskId = 0;

    /**
     * 队列号
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_queueId = 0;

    /**
     * 发送渠道类型
     * 
     * Column Type: varchar(30)
     * 
     * @var string
     */
    protected $_channel = '';

    /**
     * 短信发送号
     * 
     * Column Type: varchar(100)
     * 
     * @var string
     */
    protected $_smsNo = '';

    /**
     * 手机号
     * 
     * Column Type: varchar(11)
     * 
     * @var string
     */
    protected $_mobile = '';

    /**
     * 状态
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_status = 0;

    /**
     * 消息提示
     * 
     * Column Type: varchar(255)
     * 
     * @var string
     */
    protected $_msg = '';

    /**
     * 是否特殊处理
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_isSpecial = 0;

    /**
     * Params
     * 
     * Column Type: array
     * Default: null
     * 
     * @var array
     */
    public function getParams() {
        return $this->_params;
    }

    /**
     * Id
     * 
     * Column Type: int(11)
     * auto_increment
     * PRI
     * 
     * @param int $id
     * @return \M\Smsrecord
     */
    public function setId($id) {
        $this->_id = (int)$id;
        $this->_params['id'] = (int)$id;
        return $this;
    }

    /**
     * Id
     * 
     * Column Type: int(11)
     * auto_increment
     * PRI
     * 
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * 任务ID
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $taskId
     * @return \M\Smsrecord
     */
    public function setTaskId($taskId) {
        $this->_taskId = (int)$taskId;
        $this->_params['taskId'] = (int)$taskId;
        return $this;
    }

    /**
     * 任务ID
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getTaskId() {
        return $this->_taskId;
    }

    /**
     * 队列号
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $queueId
     * @return \M\Smsrecord
     */
    public function setQueueId($queueId) {
        $this->_queueId = (int)$queueId;
        $this->_params['queueId'] = (int)$queueId;
        return $this;
    }

    /**
     * 队列号
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getQueueId() {
        return $this->_queueId;
    }

    /**
     * 发送渠道类型
     * 
     * Column Type: varchar(30)
     * 
     * @param string $channel
     * @return \M\Smsrecord
     */
    public function setChannel($channel) {
        $this->_channel = (string)$channel;
        $this->_params['channel'] = (string)$channel;
        return $this;
    }

    /**
     * 发送渠道类型
     * 
     * Column Type: varchar(30)
     * 
     * @return string
     */
    public function getChannel() {
        return $this->_channel;
    }

    /**
     * 短信发送号
     * 
     * Column Type: varchar(100)
     * 
     * @param string $smsNo
     * @return \M\Smsrecord
     */
    public function setSmsNo($smsNo) {
        $this->_smsNo = (string)$smsNo;
        $this->_params['smsNo'] = (string)$smsNo;
        return $this;
    }

    /**
     * 短信发送号
     * 
     * Column Type: varchar(100)
     * 
     * @return string
     */
    public function getSmsNo() {
        return $this->_smsNo;
    }

    /**
     * 手机号
     * 
     * Column Type: varchar(11)
     * 
     * @param string $mobile
     * @return \M\Smsrecord
     */
    public function setMobile($mobile) {
        $this->_mobile = (string)$mobile;
        $this->_params['mobile'] = (string)$mobile;
        return $this;
    }

    /**
     * 手机号
     * 
     * Column Type: varchar(11)
     * 
     * @return string
     */
    public function getMobile() {
        return $this->_mobile;
    }

    /**
     * 状态
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @param int $status
     * @return \M\Smsrecord
     */
    public function setStatus($status) {
        $this->_status = (int)$status;
        $this->_params['status'] = (int)$status;
        return $this;
    }

    /**
     * 状态
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getStatus() {
        return $this->_status;
    }

    /**
     * 消息提示
     * 
     * Column Type: varchar(255)
     * 
     * @param string $msg
     * @return \M\Smsrecord
     */
    public function setMsg($msg) {
        $this->_msg = (string)$msg;
        $this->_params['msg'] = (string)$msg;
        return $this;
    }

    /**
     * 消息提示
     * 
     * Column Type: varchar(255)
     * 
     * @return string
     */
    public function getMsg() {
        return $this->_msg;
    }

    /**
     * 是否特殊处理
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @param int $isSpecial
     * @return \M\Smsrecord
     */
    public function setIsSpecial($isSpecial) {
        $this->_isSpecial = (int)$isSpecial;
        $this->_params['isSpecial'] = (int)$isSpecial;
        return $this;
    }

    /**
     * 是否特殊处理
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getIsSpecial() {
        return $this->_isSpecial;
    }

    /**
     * Return a array of model properties
     * 
     * @return array
     */
    public function toArray() {
        return array(
            'id'        => $this->_id,
            'taskId'    => $this->_taskId,
            'queueId'   => $this->_queueId,
            'channel'   => $this->_channel,
            'smsNo'     => $this->_smsNo,
            'mobile'    => $this->_mobile,
            'status'    => $this->_status,
            'msg'       => $this->_msg,
            'isSpecial' => $this->_isSpecial
        );
    }

}
