<?php

/**
 * Sms_order
 * 
 * @Table Schema: zk_sms
 * @Table Name: sms_order
 */
namespace M;

class SmsOrder extends \M\ModelAbstract {

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
     * 用户名
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_userId = 0;

    /**
     * 款额
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_amount = 0;

    /**
     * 1=>充值,2=>回退,3=>发送
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_type = 0;

    /**
     * 创建时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_createTime = 0;

    /**
     * 更新时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_updateTime = 0;

    /**
     * 渠道
     * 
     * Column Type: varchar(40)
     * 
     * @var string
     */
    protected $_channel = '';

    /**
     * Acter
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_acter = 0;

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
     * @return \M\Smsorder
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
     * 用户名
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $userId
     * @return \M\Smsorder
     */
    public function setUserId($userId) {
        $this->_userId = (int)$userId;
        $this->_params['userId'] = (int)$userId;
        return $this;
    }

    /**
     * 用户名
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
     * 款额
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $amount
     * @return \M\Smsorder
     */
    public function setAmount($amount) {
        $this->_amount = (int)$amount;
        $this->_params['amount'] = (int)$amount;
        return $this;
    }

    /**
     * 款额
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getAmount() {
        return $this->_amount;
    }

    /**
     * 1=>充值,2=>回退,3=>发送
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @param int $type
     * @return \M\Smsorder
     */
    public function setType($type) {
        $this->_type = (int)$type;
        $this->_params['type'] = (int)$type;
        return $this;
    }

    /**
     * 1=>充值,2=>回退,3=>发送
     * 
     * Column Type: tinyint(3) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getType() {
        return $this->_type;
    }

    /**
     * 创建时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $createTime
     * @return \M\Smsorder
     */
    public function setCreateTime($createTime) {
        $this->_createTime = (int)$createTime;
        $this->_params['createTime'] = (int)$createTime;
        return $this;
    }

    /**
     * 创建时间
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
     * 更新时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $updateTime
     * @return \M\Smsorder
     */
    public function setUpdateTime($updateTime) {
        $this->_updateTime = (int)$updateTime;
        $this->_params['updateTime'] = (int)$updateTime;
        return $this;
    }

    /**
     * 更新时间
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
     * 渠道
     * 
     * Column Type: varchar(40)
     * 
     * @param string $channel
     * @return \M\Smsorder
     */
    public function setChannel($channel) {
        $this->_channel = (string)$channel;
        $this->_params['channel'] = (string)$channel;
        return $this;
    }

    /**
     * 渠道
     * 
     * Column Type: varchar(40)
     * 
     * @return string
     */
    public function getChannel() {
        return $this->_channel;
    }

    /**
     * Acter
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @param int $acter
     * @return \M\Smsorder
     */
    public function setActer($acter) {
        $this->_acter = (int)$acter;
        $this->_params['acter'] = (int)$acter;
        return $this;
    }

    /**
     * Acter
     * 
     * Column Type: int(11) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getActer() {
        return $this->_acter;
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
            'amount'     => $this->_amount,
            'type'       => $this->_type,
            'createTime' => $this->_createTime,
            'updateTime' => $this->_updateTime,
            'channel'    => $this->_channel,
            'acter'      => $this->_acter
        );
    }

}
