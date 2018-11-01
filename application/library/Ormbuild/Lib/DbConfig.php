<?php

namespace Ormbuild\Lib;

final class DbConfig {
    protected static $_instance = null;

    private function __construct() {}
    private function __clone() {}
    private function __sleep() {}

    private $_host     = '127.0.0.1';
    private $_username = null;
    private $_password   = null;
    private $_port     = '3306';
    private $_dbname   = null;
    private $_options  = array();

    /**
     * 单例
     *
     * @return \Lib\DbConfig
     */
    public static function getInstance() {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    public function setConfig($conf, $device = 'default'){

    }

     /**
     * 连接数据库用户名
     *
     * @param string $username
     * @return \Lib\DbConfig
     */
    public function setUsername($username){
        $this->_username = (string)$username;

        return $this;
    }

    /**
     * 连接数据库用户名
     *
     * @return string
     */
    public function getUsername(){
        return $this->_username;
    }

    /**
     * 连接数据库名
     *
     * @param string $dbname
     * @return \Lib\DbConfig
     */
    public function setDbname($dbname){
        $this->_dbname = (string)$dbname;

        return $this;
    }

    /**
     * 连接数据库用户名
     *
     * @return string
     */
    public function getDbname(){
        return $this->_dbname;
    }

    /**
     * 连接数据库用户密码
     *
     * @param string $passwd
     * @return \Lib\DbConfig
     */
    public function setPassword($passwd){
        $this->_password = (string)$passwd;

        return $this;
    }

    /**
     * 连接数据库用户密码
     *
     * @return string
     */
    public function getPassword(){
        return $this->_password;
    }

    /**
     * 连接数据库主机
     *
     * @param string $host
     * @return \Lib\DbConfig
     */
    public function setHost($host){
        $this->_host = (string)$host;

        return $this;
    }

    /**
     * 连接数据库主机
     *
     * @return string
     */
    public function getHost(){
        return $this->_host;
    }

    /**
     * 连接数据库主机端口
     *
     * @param int $port
     * @return \Lib\DbConfig
     */
    public function setPort($port){
        $this->_port = (int)$port;

        return $this;
    }

    /**
     * 连接数据库主机端口
     *
     * @return int
     */
    public function getPort(){
        return $this->_port;
    }

    /**
     * 连接数据库驱动选项
     *
     * @param int $options
     * @return \Lib\DbConfig
     */
    public function setOptions($options){
        if(!is_array($options)) {
            $options = array($options);
        }

        $this->_options = (array)$options;

        return $this;
    }

    /**
     * 连接数据库驱动选项
     *
     * @return int
     */
    public function getOptions(){
        return $this->_options;
    }

    /**
     * MySQL DSN
     *
     * @return string
     */
    public function getDsn() {
        return 'mysql:host=' . $this->_host . ';port=' . $this->_port . ';dbname=' . $this->_dbname;
    }

    public function toString() {
        $ret = array();
        $ret[] = '--------------------------';
        $ret[] = 'connection information:';
        $ret[] = '    host: ' . $this->_host;
        $ret[] = 'username: ' . $this->_username;
        $ret[] = 'password: ' . str_repeat('*', mb_strlen($this->_password));
        $ret[] = '    port: ' . $this->_port;
        $ret[] = '  dbname: ' . $this->_dbname;
        $ret[] = ' options: ' . implode(' ', $this->_options);
        $ret[] = '--------------------------';

        return implode("\n", $ret);
    }
}