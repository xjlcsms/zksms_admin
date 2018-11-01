<?php

namespace Cron;

abstract class CronAbstract {

    protected $argv = null;
    protected $conf = null;
    protected $redis = null;
    protected $redis_old = null;

    final public function __construct(array $argv, \Yaf\Application $app) {
        $conf = $app->getConfig();
        $this->argv = $argv;
        $this->conf = $conf;
        $this->initAdapter();
        $this->getRedis();
        \Yaf\Registry::set('config', $conf);
    }

    /**
     * 配置
     *
     * @return \Yaf\Config\Ini
     */
    protected function getConfig() {
        return $this->conf;
    }

    /**
     * 获取参数
     *
     * @param int $index
     * @return string
     */
    protected function getArgv($index) {
        return isset($this->argv[$index]) ? $this->argv[$index] : null;
    }

    /**
     * Redis数据库
     *
     * @throws Exception 'Redis is need redis Extension!
     */
    protected function getRedis() {
        if ($this->redis instanceof \Redis) {
            return $this->redis;
        }
        $redis = \Yaf\Registry::get('redis');
        if($redis instanceof \Redis){
            $this->redis = $redis;
            return $redis;
        }
        if (!extension_loaded('redis')) {
            throw new \Exception('Redis is need redis Extension!');
        }

        $conf = $this->getConfig()->get('resources.redis');

        if (!$conf) {
            throw new \Exception('Not redis configure!', 503);
        }
        $this->redis = $this->loadRedis($conf);
        \Yaf\Registry::set('redis', $this->redis);
        return $this->redis;
    }






    protected function loadRedis($conf){
        $redis = new \Redis();

        /*
         * 连接Redis
         *
         * 当没有定义 port 时, 可以支持 sock.
         * 但是, 需要注意: 如果host是IP或者主机名时, port 的默认值是 6379
         */
        if ($conf->get('port')) {
            $status = $redis->pconnect($conf->get('host'), $conf->get('port'));
        } else {
            $status = $redis->pconnect($conf->get('host'));
        }

        if (!$status) {
            throw new \Exception('Unable to connect to the redis:' . $conf->get('host'));
        }

        // 是否有密码
        if ($conf->get('auth')) {
            $redis->auth($conf->get('auth'));
        }

        // 是否要切换Db
        if ($conf->get('db') !== null) {
            $redis->select($conf->get('db'));
        }

        // Key前缀
        if ($conf->get('options.prefix')) {
            $redis->setOption(\Redis::OPT_PREFIX, $conf->get('options.prefix'));
        }
        return $redis;
    }


    /**
     * 增加适配器
     *
     * @param string $name
     * @throws \Exception
     */
    public function initAdapter() {
        $conf = new \Yaf\Config\Ini(APPLICATION_PATH . '/conf/database.ini', \Yaf\Application::app()->environ());
        $connects = $conf->get('resources.database');
        if (!$connects) {
            throw new \Exception('Not database configure', 503);
        }

        if (isset($connects['multi'])) {
            foreach (array_keys($connects['multi']->toArray()) as $adapter){
                $dbAdapter = new \Zend\Db\Adapter\Adapter($connects['multi'][$adapter]->toArray());
                \Yaf\Registry::set($adapter.'Adapter', $dbAdapter);
            }
        } else {
            $connect = $connects;
            $dbAdapter = new \Zend\Db\Adapter\Adapter($connect->toArray());
            \Yaf\Registry::set('defaultAdapter', $dbAdapter);
        }

    }

    // 静态页面的配置
    public function getApiDomain($conName) {
        $apiIni = \Yaf\Registry::get('apiini');
        if (!$apiIni) {
            $apiIni = new \Yaf\Config\Ini(APPLICATION_PATH . '/conf/api.ini', \Yaf\Application::app()->environ());
            \Yaf\Registry::set('apiini', $apiIni);
        }
        return $apiIni->get($conName);
    }

    /**
     * 发送短信功能
     * @param $phone 手机号
     * @param $msg 内容
     */
    public function sendSms($phone,$msg){
        $sms = new \Ku\Sms\Adapter('passion');
        $driver = $sms->getDriver();
        $driver->setPhones($phone);
        $driver->setMsg($msg);
        $driver->send();
    }

    
    public function log($msg){
          echo date('Y-m-d H:i:s').'-'.$msg."\r\n";
    }
    
    public function start($msg){
         echo date('Y-m-d H:i:s').'-'.$msg.":start\r\n";
        
    }
    public function success($msg){
        echo date('Y-m-d H:i:s').'-'.$msg.":success\r\n";
    }
    public function fail($msg){
        echo date('Y-m-d H:i:s').'-'.$msg.":fail\r\n";
    }

    public function end($msg){
         echo date('Y-m-d H:i:s').'-'.$msg.":end\r\n";
        
    }

    /**
      *锁定任务
      */
    public function locked($key, $class = __CLASS__,$function = __FUNCTION__, $expire = 1200){
        
        $redis = $this->getRedis();
        $class = str_replace('\\', '.', $class);
        $lockKey = sprintf(\Ku\Consts::SYSTEM_LOCK_TASK,$class,$function,$key);
        $value = $redis->get($lockKey);
        if($value){
            return false;
        }else{
           $redis->incr($lockKey);
           $redis->expire($lockKey,$expire);
           return true;
        }
        
    }
    /**
     *解锁任务
     */
    public function unlock($key, $class = __CLASS__,$function = __FUNCTION__){
        $redis = $this->getRedis();
        $class = str_replace('\\', '.', $class);
        $lockKey = sprintf(\Ku\Consts::SYSTEM_LOCK_TASK, $class, $function, $key);
        $value = $redis->get($lockKey);
        if($value){
            $redis->delete($lockKey);
            return true;
        }
        return true;
    }
    
    public function sendSwoole($class,$method,$params){
        $config = $this->getConfig();
        $conf = $config->get('resource.swoole.client');
        $client = new swoole_client(SWOOLE_SOCK_TCP);
            if (!$client->connect($conf['host'], $conf['port'], -1))
            {
                exit("connect failed. Error: {$client->errCode}\n");
            }
            $data['class'] = $class;
            $data['method'] = $method;
            $data['params'] = $params;
            $client->send(\json_encode($data));
            $back = $client->recv();
            $client->close();
            return $back; 
    }

        abstract public function main();
}
