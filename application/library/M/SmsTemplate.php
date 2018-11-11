<?php

/**
 * Sms_template
 * 
 * @Table Schema: zk_sms
 * @Table Name: sms_template
 */
namespace M;

class SmsTemplate extends \M\ModelAbstract {

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
     * UserId
     * 
     * Column Type: int(10) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_userId = 0;

    /**
     * 属性,0=>code,1=>
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_classify = 0;

    /**
     * Sign
     * 
     * Column Type: varchar(20)
     * 
     * @var string
     */
    protected $_sign = '';

    /**
     * Content
     * 
     * Column Type: varchar(500)
     * 
     * @var string
     */
    protected $_content = '';

    /**
     * Status
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_status = 0;

    /**
     * Reason
     * 
     * Column Type: varchar(100)
     * 
     * @var string
     */
    protected $_reason = '';

    /**
     * CreateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_createTime = 0;

    /**
     * UpdateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_updateTime = 0;

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
     * @return \M\Smstemplate
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
     * UserId
     * 
     * Column Type: int(10) unsigned
     * Default: 0
     * 
     * @param int $userId
     * @return \M\Smstemplate
     */
    public function setUserId($userId) {
        $this->_userId = (int)$userId;
        $this->_params['userId'] = (int)$userId;
        return $this;
    }

    /**
     * UserId
     * 
     * Column Type: int(10) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getUserId() {
        return $this->_userId;
    }

    /**
     * 属性,0=>code,1=>
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @param int $classify
     * @return \M\Smstemplate
     */
    public function setClassify($classify) {
        $this->_classify = (int)$classify;
        $this->_params['classify'] = (int)$classify;
        return $this;
    }

    /**
     * 属性,0=>code,1=>
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getClassify() {
        return $this->_classify;
    }

    /**
     * Sign
     * 
     * Column Type: varchar(20)
     * 
     * @param string $sign
     * @return \M\Smstemplate
     */
    public function setSign($sign) {
        $this->_sign = (string)$sign;
        $this->_params['sign'] = (string)$sign;
        return $this;
    }

    /**
     * Sign
     * 
     * Column Type: varchar(20)
     * 
     * @return string
     */
    public function getSign() {
        return $this->_sign;
    }

    /**
     * Content
     * 
     * Column Type: varchar(500)
     * 
     * @param string $content
     * @return \M\Smstemplate
     */
    public function setContent($content) {
        $this->_content = (string)$content;
        $this->_params['content'] = (string)$content;
        return $this;
    }

    /**
     * Content
     * 
     * Column Type: varchar(500)
     * 
     * @return string
     */
    public function getContent() {
        return $this->_content;
    }

    /**
     * Status
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @param int $status
     * @return \M\Smstemplate
     */
    public function setStatus($status) {
        $this->_status = (int)$status;
        $this->_params['status'] = (int)$status;
        return $this;
    }

    /**
     * Status
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
     * Reason
     * 
     * Column Type: varchar(100)
     * 
     * @param string $reason
     * @return \M\Smstemplate
     */
    public function setReason($reason) {
        $this->_reason = (string)$reason;
        $this->_params['reason'] = (string)$reason;
        return $this;
    }

    /**
     * Reason
     * 
     * Column Type: varchar(100)
     * 
     * @return string
     */
    public function getReason() {
        return $this->_reason;
    }

    /**
     * CreateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $createTime
     * @return \M\Smstemplate
     */
    public function setCreateTime($createTime) {
        $this->_createTime = (int)$createTime;
        $this->_params['createTime'] = (int)$createTime;
        return $this;
    }

    /**
     * CreateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getCreateTime() {
        return $this->_createTime;
    }

    /**
     * UpdateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $updateTime
     * @return \M\Smstemplate
     */
    public function setUpdateTime($updateTime) {
        $this->_updateTime = (int)$updateTime;
        $this->_params['updateTime'] = (int)$updateTime;
        return $this;
    }

    /**
     * UpdateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getUpdateTime() {
        return $this->_updateTime;
    }

    /**
     * Return a array of model properties
     * 
     * @return array
     */
    public function toArray() {
        return array(
            'id'         => $this->_id,
            'userId'     => $this->_userId,
            'classify'   => $this->_classify,
            'sign'       => $this->_sign,
            'content'    => $this->_content,
            'status'     => $this->_status,
            'reason'     => $this->_reason,
            'createTime' => $this->_createTime,
            'updateTime' => $this->_updateTime
        );
    }

}
