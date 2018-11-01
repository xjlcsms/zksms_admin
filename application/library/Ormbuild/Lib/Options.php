<?php

namespace Ormbuild\Lib;

final class Options {

    protected static $_instance = null;
    protected $_mapOptions = array(
        102 => 'filepath',     // +f
        101 => 'extendName',   // +e
        105 => 'implements',   // +i
        120 => 'ext',          // +x
        108 => 'underline',    // +l
        76  => 'colunderline', // +L
        109 => 'modelType',    // +m
        82  => 'replace',      // +R
        78  => 'namespace',    // +N
        70  => 'final',        // +F
        111 => 'onNamespace',  // +o
        100 => 'dbConfig',     // +d
        84  => 'tab',          // +T
        117 => 'username',     // +u
        85  => 'ucwords',      // +U
        104 => 'host',         // +h
        112 => 'passwd',       // +p
        110 => 'dbname',       // +n
        80  => 'port',         // +P
        79  => 'options',      // +O
        116 => 'table'         // +t
      );

    private $_filepath     = '';
    private $_extendName   = '\M\ModelAbstract';
    private $_implements   = null;
    private $_modelType    = '%s';
    private $_replace      = null;
    private $_ext          = '.php';
    private $_tab          = '    '; // 4空格
    private $_namespace    = '\\';
    private $_final        = false;
    private $_underline    = false;
    private $_ucwords      = true;
    private $_colunderline = true;
    private $_onNamespace  = true;
    private $_dbConfig     = null;
    private $_host         = null;
    private $_username     = null;
    private $_passwd       = null;
    private $_port         = null;
    private $_dbname       = null;
    private $_options      = array("SET NAMES 'utf8'");
    private $_table        = null;

    private function __construct() {}

    /**
     * 单例
     *
     * @return \Lib\Options
     */
    public static function getInstance() {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * 选项名
     *
     * @param int $code
     * @return string
     */
    public function getOptionsName($code){
        return (isset($this->_mapOptions[$code])) ? $this->_mapOptions[$code] : null;
    }

    /**
     * 设置写入文件路径
     *
     * @param string $filepath
     * @return \Lib\Optioins
     */
    public function setFilepath($filepath){
        $this->_filepath = (string)$filepath;

        return $this;
    }

    /**
     * 设置写入文件路径
     *
     * @return string
     */
    public function getFilepath(){
        return (empty($this->_filepath) ? APP_PATH . DS . 'BuildResult' : $this->_filepath);
    }

    /**
     * 扩展类名
     *
     * @param string $extendName
     * @return \Lib\Optioins
     */
    public function setExtendName($extendName){
        $this->_extendName = (string)$extendName;

        return $this;
    }

    /**
     * 扩展类名
     *
     * @return string
     */
    public function getExtendName(){
        $extendName = $this->_extendName;

        if($this->_onNamespace === false){
            $extendName = trim(str_replace('\\', '_', $extendName), '_');
        }

        return $extendName;
    }

    /**
     * 类接口
     *
     * @param string $implements
     * @return \Lib\Optioins
     */
    public function setImplements($implements){
        $this->_implements = (string)$implements;

        return $this;
    }

    /**
     * 类接口
     *
     * @return string
     */
    public function getImplements(){
        $implements = $this->_implements;

        if($this->_onNamespace === false){
            $implements = trim(str_replace('\\', '_', $implements), '_');
        }

        return $implements;
    }

    /**
     * 模型后缀格式
     *
     * @param string $modelType
     * @return \Lib\Optioins
     */
    public function setModelType($modelType){
        switch ((int)($modelType)){
            case 2:
                $format = 'Model%s';
                break;
            case 3:
                $format = '%s_Model';
                break;
            case 4:
                $format = 'Model_%s';
                break;
            case 1:
            default :
                $format = '%sModel';
                break;
        }

        $this->_modelType = (string)$format;

        return $this;
    }

    /**
     * 模型后缀格式
     *
     * @return string
     */
    public function getModelType(){
        return $this->_modelType;
    }

    /**
     * 模型名称字符替换
     *
     * @param string $modelType
     * @return \Lib\Optioins
     */
    public function setReplace($replaceStr){
        $replaceArr = explode(':', $replaceStr);

        if(count($replaceArr) === 2) {
            $this->_replace = $replaceArr;
        }

        return $this;
    }

    /**
     * 模型名称字符替换
     *
     * @return string
     */
    public function getReplace(){
        return [
            'source' => !empty($this->_replace[0]) ? $this->_replace[0] : '',
            'target' => !empty($this->_replace[1]) ? $this->_replace[1] : ''
        ];
    }

    /**
     * 数据库配置
     *
     * @param string|false $dbConfig
     * @return \Lib\Options
     */
    public function setDbConfig($dbConfig){
        $this->_dbConfig = ($dbConfig === false) ? false : (string)$dbConfig;

        return $this;
    }

    /**
     * 数据库配置
     *
     * @return string
     */
    public function getDbConfig(){
        return $this->_dbConfig;
    }

    /**
     * 文件后缀
     *
     * @param string $ext
     * @return \Lib\Options
     */
    public function setExt($ext){
        $this->_ext = '.' . trim((string)$ext, '.');

        return $this;
    }

    /**
     * 文件后缀
     *
     * @return string
     */
    public function getExt(){
        return $this->_ext;
    }

    /**
     * 文件后缀
     *
     * @param int $tab
     * @return \Lib\Options
     */
    public function setTab($tab){
        $this->_tab = $tab > 0 ? str_repeat(' ', $tab) : "\t";

        return $this;
    }

    /**
     * 文件后缀
     *
     * @return string
     */
    public function getTab(){
        return $this->_tab;
    }

    /**
     * 单词首字母大小写
     *
     * @param bool|int $ucwords
     * @return \Lib\Options
     */
    public function setUcwords($ucwords) {
        $this->_ucwords = (bool)$ucwords;

        return $this;
    }

    /**
     * 单词首字母大小写
     *
     * @return boolean
     */
    public function getUcwords() {
        return $this->_ucwords;
    }

    /**
     * 连接数据库用户名
     *
     * @param string $username
     * @return \Lib\Options
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
     * @return \Lib\Options
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
     * 需要操作的表名
     *
     * @param string $table
     * @return \Lib\Options
     */
    public function setTable($table){
        $this->_table = explode(',', $table);

        return $this;
    }

    /**
     * 需要操作的表名
     *
     * @return array()
     */
    public function getTable(){
        return $this->_table;
    }

    /**
     * 连接数据库用户密码
     *
     * @param string $passwd
     * @return \Lib\Options
     */
    public function setPasswd($passwd){
        $this->_passwd = (string)$passwd;

        return $this;
    }

    /**
     * 连接数据库用户密码
     *
     * @return string
     */
    public function getPasswd(){
        return $this->_passwd;
    }

    /**
     * 连接数据库主机
     *
     * @param string $host
     * @return \Lib\Options
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
     * @return \Lib\Options
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
        if(is_string($options)) {
            $options = explode(',', $options);
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
     * 命名空间启用状态
     *
     * @param string $onNamespace
     * @return \Lib\Options
     */
    public function setOnNamespace($onNamespace){
        $this->_onNamespace = (bool)$onNamespace;

        return $this;
    }

    /**
     * 命名空间启用状态
     *
     * @return string
     */
    public function getOnNamespace(){
        return (boolean)$this->_onNamespace;
    }

    /**
     * 当前model的命名空间
     *
     * @param string $namespace
     * @return \Lib\Options
     */
    public function setNamespace($namespace){
        $this->_namespace = (string)$namespace;

        return $this;
    }

    /**
     * 当前model的命名空间
     *
     * @return string
     */
    public function getNamespace(){
        $namespace = trim($this->_namespace, '\\');

        if($this->_onNamespace === true){
            $namespace = empty($namespace) ? '\\' : '\\' . $namespace . '\\';
        } else if(!empty($namespace)){
            $namespace = str_replace('\\', '_', $namespace) . '_';
        }

        return $namespace;
    }

    /**
     * 是否是final类
     *
     * @param boolean $final
     * @return \Lib\Options
     */
    public function setFinal($final){
        $this->_final = (bool)$final;

        return $this;
    }

    /**
     * 是否是final类
     *
     * @return string
     */
    public function getFinal(){
        return $this->_final;
    }

    /**
     * 下划线
     *
     * @param boolean|1|0 $underline
     * @return \Lib\Options
     */
    public function setUnderline($underline){
        $this->_underline = (bool)$underline;

        return $this;
    }

    /**
     * 下划线
     *
     * @return boolean
     */
    public function getUnderline(){
        return (bool)$this->_underline;
    }

    /**
     * 列名下划线
     *
     * @param boolean|1|0 $colunderline
     * @return \Lib\Options
     */
    public function setColunderline($colunderline){
        $this->_colunderline = (bool)$colunderline;

        return $this;
    }

    /**
     * 列名下划线
     *
     * @return boolean
     */
    public function getColunderline(){
        return (bool)$this->_colunderline;
    }
}
