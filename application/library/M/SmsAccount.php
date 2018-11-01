<?php

/**
 * 账户表
 * 
 * @Table Schema: zk_sms
 * @Table Name: sms_account
 */
namespace M;

class SmsAccount extends \M\ModelAbstract {

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
     * 用户ID
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @var int
     */
    protected $_userId = 0;

    /**
     * 验证码余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @var int
     */
    protected $_code = 0;

    /**
     * 通知类余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @var int
     */
    protected $_normal = 0;

    /**
     * 营销余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @var int
     */
    protected $_market = 0;

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
     * @return \M\Smsaccount
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
     * 用户ID
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @param int $userId
     * @return \M\Smsaccount
     */
    public function setUserId($userId) {
        $this->_userId = (int)$userId;
        $this->_params['userId'] = (int)$userId;
        return $this;
    }

    /**
     * 用户ID
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @return int
     */
    public function getUserId() {
        return $this->_userId;
    }

    /**
     * 验证码余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @param int $code
     * @return \M\Smsaccount
     */
    public function setCode($code) {
        $this->_code = (int)$code;
        $this->_params['code'] = (int)$code;
        return $this;
    }

    /**
     * 验证码余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @return int
     */
    public function getCode() {
        return $this->_code;
    }

    /**
     * 通知类余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @param int $normal
     * @return \M\Smsaccount
     */
    public function setNormal($normal) {
        $this->_normal = (int)$normal;
        $this->_params['normal'] = (int)$normal;
        return $this;
    }

    /**
     * 通知类余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @return int
     */
    public function getNormal() {
        return $this->_normal;
    }

    /**
     * 营销余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @param int $market
     * @return \M\Smsaccount
     */
    public function setMarket($market) {
        $this->_market = (int)$market;
        $this->_params['market'] = (int)$market;
        return $this;
    }

    /**
     * 营销余额
     * 
     * Column Type: int(11)
     * Default: 0
     * 
     * @return int
     */
    public function getMarket() {
        return $this->_market;
    }

    /**
     * UpdateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $updateTime
     * @return \M\Smsaccount
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
            'code'       => $this->_code,
            'normal'     => $this->_normal,
            'market'     => $this->_market,
            'updateTime' => $this->_updateTime
        );
    }

}
