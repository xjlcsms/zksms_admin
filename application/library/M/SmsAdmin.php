<?php

/**
 * Sms_admin
 * 
 * @Table Schema: zk_sms
 * @Table Name: sms_admin
 */
namespace M;

class SmsAdmin extends \M\ModelAbstract {

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
     * UserName
     * 
     * Column Type: varchar(45)
     * 
     * @var string
     */
    protected $_userName = '';

    /**
     * Password
     * 
     * Column Type: varchar(60)
     * 
     * @var string
     */
    protected $_password = '';

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
     * LoginTime
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
     * Group
     * 
     * Column Type: tinyint(2) unsigned
     * Default: 0
     * 
     * @var int
     */
    protected $_group = 0;

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
     * @return \M\Smsadmin
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
     * UserName
     * 
     * Column Type: varchar(45)
     * 
     * @param string $userName
     * @return \M\Smsadmin
     */
    public function setUserName($userName) {
        $this->_userName = (string)$userName;
        $this->_params['userName'] = (string)$userName;
        return $this;
    }

    /**
     * UserName
     * 
     * Column Type: varchar(45)
     * 
     * @return string
     */
    public function getUserName() {
        return $this->_userName;
    }

    /**
     * Password
     * 
     * Column Type: varchar(60)
     * 
     * @param string $password
     * @return \M\Smsadmin
     */
    public function setPassword($password) {
        $this->_password = (string)$password;
        $this->_params['password'] = (string)$password;
        return $this;
    }

    /**
     * Password
     * 
     * Column Type: varchar(60)
     * 
     * @return string
     */
    public function getPassword() {
        return $this->_password;
    }

    /**
     * CreateTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $createTime
     * @return \M\Smsadmin
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
     * @return \M\Smsadmin
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
     * LoginTime
     * 
     * Column Type: bigint(20) unsigned
     * Default: 0
     * 
     * @param int $loginTime
     * @return \M\Smsadmin
     */
    public function setLoginTime($loginTime) {
        $this->_loginTime = (int)$loginTime;
        $this->_params['loginTime'] = (int)$loginTime;
        return $this;
    }

    /**
     * LoginTime
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
     * @return \M\Smsadmin
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
     * Group
     * 
     * Column Type: tinyint(2) unsigned
     * Default: 0
     * 
     * @param int $group
     * @return \M\Smsadmin
     */
    public function setGroup($group) {
        $this->_group = (int)$group;
        $this->_params['group'] = (int)$group;
        return $this;
    }

    /**
     * Group
     * 
     * Column Type: tinyint(2) unsigned
     * Default: 0
     * 
     * @return int
     */
    public function getGroup() {
        return $this->_group;
    }

    /**
     * Return a array of model properties
     * 
     * @return array
     */
    public function toArray() {
        return array(
            'id'         => $this->_id,
            'userName'   => $this->_userName,
            'password'   => $this->_password,
            'createTime' => $this->_createTime,
            'updateTime' => $this->_updateTime,
            'loginTime'  => $this->_loginTime,
            'loginIp'    => $this->_loginIp,
            'group'      => $this->_group
        );
    }

}
