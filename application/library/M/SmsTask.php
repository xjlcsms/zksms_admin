<?php

/**
 * Sms_task
 * 
 * @Table Schema: zk_sms
 * @Table Name: sms_task
 */
namespace M;

class SmsTask extends \M\ModelAbstract {

    /**
     * Params
     * 
     * @var array
     */
    protected $_params = null;

    /**
     * Id
     * 
     * Column Type: int(10) unsigned
     * auto_increment
     * PRI
     * 
     * @var int
     */
    protected $_id = null;

    /**
     * 用户Id
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_userId = 0;

    /**
     * 是否系统代发
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_isSys = 0;

    /**
     * 0待发送,1成功,2失败,3驳回
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_status = 0;

    /**
     * 签名
     * 
     * Column Type: varchar(20)
     * 
     * @var string
     */
    protected $_sign = '';

    /**
     * 发送内容,包含签名
     * 
     * Column Type: varchar(800)
     * 
     * @var string
     */
    protected $_content = '';

    /**
     * 到达率
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 100
     * 
     * @var int
     */
    protected $_rate = 100;

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
     * 发送时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_sendTime = 0;

    /**
     * 成功时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_successTime = 0;

    /**
     * 总发送数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_sendTotal = 0;

    /**
     * 实发数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_sendNum = 0;

    /**
     * 成功数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_successNum = 0;

    /**
     * 失败数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_failNum = 0;

    /**
     * 成功回调数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_pullNum = 0;

    /**
     * 每条计费
     * 
     * Column Type: tinyint(2) unsigned
     * Default: 1
     * 
     * @var int
     */
    protected $_fee = 1;

    /**
     * 驳回理由
     * 
     * Column Type: varchar(255)
     * 
     * @var string
     */
    protected $_reason = '';

    /**
     * 处理状态0
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_isDeal = 0;

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
     * Column Type: int(10) unsigned
     * auto_increment
     * PRI
     * 
     * @param int $id
     * @return \M\Smstask
     */
    public function setId($id) {
        $this->_id = (int)$id;
        $this->_params['id'] = (int)$id;
        return $this;
    }

    /**
     * Id
     * 
     * Column Type: int(10) unsigned
     * auto_increment
     * PRI
     * 
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * 用户Id
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $userId
     * @return \M\Smstask
     */
    public function setUserId($userId) {
        $this->_userId = (int)$userId;
        $this->_params['userId'] = (int)$userId;
        return $this;
    }

    /**
     * 用户Id
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getUserId() {
        return $this->_userId;
    }

    /**
     * 是否系统代发
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @param int $isSys
     * @return \M\Smstask
     */
    public function setIsSys($isSys) {
        $this->_isSys = (int)$isSys;
        $this->_params['isSys'] = (int)$isSys;
        return $this;
    }

    /**
     * 是否系统代发
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getIsSys() {
        return $this->_isSys;
    }

    /**
     * 0待发送,1成功,2失败,3驳回
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @param int $status
     * @return \M\Smstask
     */
    public function setStatus($status) {
        $this->_status = (int)$status;
        $this->_params['status'] = (int)$status;
        return $this;
    }

    /**
     * 0待发送,1成功,2失败,3驳回
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
     * 签名
     * 
     * Column Type: varchar(20)
     * 
     * @param string $sign
     * @return \M\Smstask
     */
    public function setSign($sign) {
        $this->_sign = (string)$sign;
        $this->_params['sign'] = (string)$sign;
        return $this;
    }

    /**
     * 签名
     * 
     * Column Type: varchar(20)
     * 
     * @return string
     */
    public function getSign() {
        return $this->_sign;
    }

    /**
     * 发送内容,包含签名
     * 
     * Column Type: varchar(800)
     * 
     * @param string $content
     * @return \M\Smstask
     */
    public function setContent($content) {
        $this->_content = (string)$content;
        $this->_params['content'] = (string)$content;
        return $this;
    }

    /**
     * 发送内容,包含签名
     * 
     * Column Type: varchar(800)
     * 
     * @return string
     */
    public function getContent() {
        return $this->_content;
    }

    /**
     * 到达率
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 100
     * 
     * @param int $rate
     * @return \M\Smstask
     */
    public function setRate($rate) {
        $this->_rate = (int)$rate;
        $this->_params['rate'] = (int)$rate;
        return $this;
    }

    /**
     * 到达率
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 100
     * 
     * @return int
     */
    public function getRate() {
        return $this->_rate;
    }

    /**
     * CreateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $createTime
     * @return \M\Smstask
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
     * @return \M\Smstask
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
     * 发送时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $sendTime
     * @return \M\Smstask
     */
    public function setSendTime($sendTime) {
        $this->_sendTime = (int)$sendTime;
        $this->_params['sendTime'] = (int)$sendTime;
        return $this;
    }

    /**
     * 发送时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getSendTime() {
        return $this->_sendTime;
    }

    /**
     * 成功时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $successTime
     * @return \M\Smstask
     */
    public function setSuccessTime($successTime) {
        $this->_successTime = (int)$successTime;
        $this->_params['successTime'] = (int)$successTime;
        return $this;
    }

    /**
     * 成功时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getSuccessTime() {
        return $this->_successTime;
    }

    /**
     * 总发送数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $sendTotal
     * @return \M\Smstask
     */
    public function setSendTotal($sendTotal) {
        $this->_sendTotal = (int)$sendTotal;
        $this->_params['sendTotal'] = (int)$sendTotal;
        return $this;
    }

    /**
     * 总发送数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getSendTotal() {
        return $this->_sendTotal;
    }

    /**
     * 实发数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $sendNum
     * @return \M\Smstask
     */
    public function setSendNum($sendNum) {
        $this->_sendNum = (int)$sendNum;
        $this->_params['sendNum'] = (int)$sendNum;
        return $this;
    }

    /**
     * 实发数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getSendNum() {
        return $this->_sendNum;
    }

    /**
     * 成功数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $successNum
     * @return \M\Smstask
     */
    public function setSuccessNum($successNum) {
        $this->_successNum = (int)$successNum;
        $this->_params['successNum'] = (int)$successNum;
        return $this;
    }

    /**
     * 成功数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getSuccessNum() {
        return $this->_successNum;
    }

    /**
     * 失败数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $failNum
     * @return \M\Smstask
     */
    public function setFailNum($failNum) {
        $this->_failNum = (int)$failNum;
        $this->_params['failNum'] = (int)$failNum;
        return $this;
    }

    /**
     * 失败数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getFailNum() {
        return $this->_failNum;
    }

    /**
     * 成功回调数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $pullNum
     * @return \M\Smstask
     */
    public function setPullNum($pullNum) {
        $this->_pullNum = (int)$pullNum;
        $this->_params['pullNum'] = (int)$pullNum;
        return $this;
    }

    /**
     * 成功回调数量
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getPullNum() {
        return $this->_pullNum;
    }

    /**
     * 每条计费
     * 
     * Column Type: tinyint(2) unsigned
     * Default: 1
     * 
     * @param int $fee
     * @return \M\Smstask
     */
    public function setFee($fee) {
        $this->_fee = (int)$fee;
        $this->_params['fee'] = (int)$fee;
        return $this;
    }

    /**
     * 每条计费
     * 
     * Column Type: tinyint(2) unsigned
     * Default: 1
     * 
     * @return int
     */
    public function getFee() {
        return $this->_fee;
    }

    /**
     * 驳回理由
     * 
     * Column Type: varchar(255)
     * 
     * @param string $reason
     * @return \M\Smstask
     */
    public function setReason($reason) {
        $this->_reason = (string)$reason;
        $this->_params['reason'] = (string)$reason;
        return $this;
    }

    /**
     * 驳回理由
     * 
     * Column Type: varchar(255)
     * 
     * @return string
     */
    public function getReason() {
        return $this->_reason;
    }

    /**
     * 处理状态0
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @param int $isDeal
     * @return \M\Smstask
     */
    public function setIsDeal($isDeal) {
        $this->_isDeal = (int)$isDeal;
        $this->_params['isDeal'] = (int)$isDeal;
        return $this;
    }

    /**
     * 处理状态0
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getIsDeal() {
        return $this->_isDeal;
    }

    /**
     * Return a array of model properties
     * 
     * @return array
     */
    public function toArray() {
        return array(
            'id'          => $this->_id,
            'userId'      => $this->_userId,
            'isSys'       => $this->_isSys,
            'status'      => $this->_status,
            'sign'        => $this->_sign,
            'content'     => $this->_content,
            'rate'        => $this->_rate,
            'createTime'  => $this->_createTime,
            'updateTime'  => $this->_updateTime,
            'sendTime'    => $this->_sendTime,
            'successTime' => $this->_successTime,
            'sendTotal'   => $this->_sendTotal,
            'sendNum'     => $this->_sendNum,
            'successNum'  => $this->_successNum,
            'failNum'     => $this->_failNum,
            'pullNum'     => $this->_pullNum,
            'fee'         => $this->_fee,
            'reason'      => $this->_reason,
            'isDeal'      => $this->_isDeal
        );
    }

}
