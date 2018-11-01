<?php

/**
 * 处理队列
 * 
 * @Table Schema: zk_sms
 * @Table Name: sms_queue
 */
namespace M;

class SmsQueue extends \M\ModelAbstract {

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
     * 队列id
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @var int
     */
    protected $_taskId = 0;

    /**
     * 发送手机号
     * 
     * Column Type: text
     * 
     * @var string
     */
    protected $_sendMobiles = null;

    /**
     * FailMobiles
     * 
     * Column Type: text
     * 
     * @var string
     */
    protected $_failMobiles = null;

    /**
     * 队列状态
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_status = 0;

    /**
     * 发送结果
     * 
     * Column Type: text
     * 
     * @var string
     */
    protected $_result = null;

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
     * @return \M\Smsqueue
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
     * 队列id
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @param int $taskId
     * @return \M\Smsqueue
     */
    public function setTaskId($taskId) {
        $this->_taskId = (int)$taskId;
        $this->_params['taskId'] = (int)$taskId;
        return $this;
    }

    /**
     * 队列id
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @return int
     */
    public function getTaskId() {
        return $this->_taskId;
    }

    /**
     * 发送手机号
     * 
     * Column Type: text
     * 
     * @param string $sendMobiles
     * @return \M\Smsqueue
     */
    public function setSendMobiles($sendMobiles) {
        $this->_sendMobiles = (string)$sendMobiles;
        $this->_params['sendMobiles'] = (string)$sendMobiles;
        return $this;
    }

    /**
     * 发送手机号
     * 
     * Column Type: text
     * 
     * @return string
     */
    public function getSendMobiles() {
        return $this->_sendMobiles;
    }

    /**
     * FailMobiles
     * 
     * Column Type: text
     * 
     * @param string $failMobiles
     * @return \M\Smsqueue
     */
    public function setFailMobiles($failMobiles) {
        $this->_failMobiles = (string)$failMobiles;
        $this->_params['failMobiles'] = (string)$failMobiles;
        return $this;
    }

    /**
     * FailMobiles
     * 
     * Column Type: text
     * 
     * @return string
     */
    public function getFailMobiles() {
        return $this->_failMobiles;
    }

    /**
     * 队列状态
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @param int $status
     * @return \M\Smsqueue
     */
    public function setStatus($status) {
        $this->_status = (int)$status;
        $this->_params['status'] = (int)$status;
        return $this;
    }

    /**
     * 队列状态
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
     * 发送结果
     * 
     * Column Type: text
     * 
     * @param string $result
     * @return \M\Smsqueue
     */
    public function setResult($result) {
        $this->_result = (string)$result;
        $this->_params['result'] = (string)$result;
        return $this;
    }

    /**
     * 发送结果
     * 
     * Column Type: text
     * 
     * @return string
     */
    public function getResult() {
        return $this->_result;
    }

    /**
     * Return a array of model properties
     * 
     * @return array
     */
    public function toArray() {
        return array(
            'id'          => $this->_id,
            'taskId'      => $this->_taskId,
            'sendMobiles' => $this->_sendMobiles,
            'failMobiles' => $this->_failMobiles,
            'status'      => $this->_status,
            'result'      => $this->_result
        );
    }

}
