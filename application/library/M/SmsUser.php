<?php

/**
 * Sms_user
 * 
 * @Table Schema: zk_sms
 * @Table Name: sms_user
 */
namespace M;

class SmsUser extends \M\ModelAbstract {

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
     * Name
     * 
     * Column Type: varchar(45)
     * 
     * @var string
     */
    protected $_name = '';

    /**
     * 账号
     * 
     * Column Type: varchar(45)
     * 
     * @var string
     */
    protected $_acount = '';

    /**
     * 密码
     * 
     * Column Type: varchar(60)
     * 
     * @var string
     */
    protected $_password = '';

    /**
     * Type
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_type = 0;

    /**
     * 到达率
     * 
     * Column Type: tinyint(3)
     * Default: 100
     * 
     * @var int
     */
    protected $_rate = 100;

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
     * 登录时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_loginTime = 0;

    /**
     * LoginIp
     * 
     * Column Type: varchar(45)
     * 
     * @var string
     */
    protected $_loginIp = '';

    /**
     * CallbackUrl
     * 
     * Column Type: varchar(256)
     * 
     * @var string
     */
    protected $_callbackUrl = '';

    /**
     * 回调地址
     * 
     * Column Type: tinyint(1)
     * Default: 0
     * 
     * @var int
     */
    protected $_isdel = 0;

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
     * @return \M\Smsuser
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
     * Name
     * 
     * Column Type: varchar(45)
     * 
     * @param string $name
     * @return \M\Smsuser
     */
    public function setName($name) {
        $this->_name = (string)$name;
        $this->_params['name'] = (string)$name;
        return $this;
    }

    /**
     * Name
     * 
     * Column Type: varchar(45)
     * 
     * @return string
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * 账号
     * 
     * Column Type: varchar(45)
     * 
     * @param string $acount
     * @return \M\Smsuser
     */
    public function setAcount($acount) {
        $this->_acount = (string)$acount;
        $this->_params['acount'] = (string)$acount;
        return $this;
    }

    /**
     * 账号
     * 
     * Column Type: varchar(45)
     * 
     * @return string
     */
    public function getAcount() {
        return $this->_acount;
    }

    /**
     * 密码
     * 
     * Column Type: varchar(60)
     * 
     * @param string $password
     * @return \M\Smsuser
     */
    public function setPassword($password) {
        $this->_password = (string)$password;
        $this->_params['password'] = (string)$password;
        return $this;
    }

    /**
     * 密码
     * 
     * Column Type: varchar(60)
     * 
     * @return string
     */
    public function getPassword() {
        return $this->_password;
    }

    /**
     * Type
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @param int $type
     * @return \M\Smsuser
     */
    public function setType($type) {
        $this->_type = (int)$type;
        $this->_params['type'] = (int)$type;
        return $this;
    }

    /**
     * Type
     * 
     * Column Type: tinyint(1) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getType() {
        return $this->_type;
    }

    /**
     * 到达率
     * 
     * Column Type: tinyint(3)
     * Default: 100
     * 
     * @param int $rate
     * @return \M\Smsuser
     */
    public function setRate($rate) {
        $this->_rate = (int)$rate;
        $this->_params['rate'] = (int)$rate;
        return $this;
    }

    /**
     * 到达率
     * 
     * Column Type: tinyint(3)
     * Default: 100
     * 
     * @return int
     */
    public function getRate() {
        return $this->_rate;
    }

    /**
     * 创建时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $createTime
     * @return \M\Smsuser
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
     * @return \M\Smsuser
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
     * 登录时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $loginTime
     * @return \M\Smsuser
     */
    public function setLoginTime($loginTime) {
        $this->_loginTime = (int)$loginTime;
        $this->_params['loginTime'] = (int)$loginTime;
        return $this;
    }

    /**
     * 登录时间
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getLoginTime() {
        return $this->_loginTime;
    }

    /**
     * LoginIp
     * 
     * Column Type: varchar(45)
     * 
     * @param string $loginIp
     * @return \M\Smsuser
     */
    public function setLoginIp($loginIp) {
        $this->_loginIp = (string)$loginIp;
        $this->_params['loginIp'] = (string)$loginIp;
        return $this;
    }

    /**
     * LoginIp
     * 
     * Column Type: varchar(45)
     * 
     * @return string
     */
    public function getLoginIp() {
        return $this->_loginIp;
    }

    /**
     * CallbackUrl
     * 
     * Column Type: varchar(256)
     * 
     * @param string $callbackUrl
     * @return \M\Smsuser
     */
    public function setCallbackUrl($callbackUrl) {
        $this->_callbackUrl = (string)$callbackUrl;
        $this->_params['callbackUrl'] = (string)$callbackUrl;
        return $this;
    }

    /**
     * CallbackUrl
     * 
     * Column Type: varchar(256)
     * 
     * @return string
     */
    public function getCallbackUrl() {
        return $this->_callbackUrl;
    }

    /**
     * 回调地址
     * 
     * Column Type: tinyint(1)
     * Default: 0
     * 
     * @param int $isdel
     * @return \M\Smsuser
     */
    public function setIsdel($isdel) {
        $this->_isdel = (int)$isdel;
        $this->_params['isdel'] = (int)$isdel;
        return $this;
    }

    /**
     * 回调地址
     * 
     * Column Type: tinyint(1)
     * Default: 0
     * 
     * @return int
     */
    public function getIsdel() {
        return $this->_isdel;
    }

    /**
     * Return a array of model properties
     * 
     * @return array
     */
    public function toArray() {
        return array(
            'id'          => $this->_id,
            'name'        => $this->_name,
            'acount'      => $this->_acount,
            'password'    => $this->_password,
            'type'        => $this->_type,
            'rate'        => $this->_rate,
            'createTime'  => $this->_createTime,
            'updateTime'  => $this->_updateTime,
            'loginTime'   => $this->_loginTime,
            'loginIp'     => $this->_loginIp,
            'callbackUrl' => $this->_callbackUrl,
            'isdel'       => $this->_isdel
        );
    }

}
