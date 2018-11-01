<?php

namespace Base;

class ApplicationController extends \Base\AbstractController {

    protected $_user = null;
    //模块/控制器/方法/
    protected $_mc = array(
        'login'=>'*',
        );

    protected function before() {
       if ($this->isFilter() === false) {
            $info = \Business\Login::getInstance()->getLoginUser();
           if ($info === null) {
                if ($this->getRequest()->isXmlHttpRequest() === true) {
                    $this->returnData('登录过期，请重新登录', 504);
                } else {
                    if (isset($_SERVER["HTTP_REFERER"])) {
                        $this->redirect("/login?url=" . $_SERVER["HTTP_REFERER"]);
                    } else {
                        $this->redirect("/login");
                    }
                }
                exit();
            }
        }

    }

    /**
     * 过滤不需要登录的接口
     * @return boolean
     */
    protected function isFilter() {
        $controller = strtolower($this->getRequest()->getControllerName());
        $action = strtolower(($this->getRequest()->getActionName()));
        $module = strtolower(($this->getRequest()->getModuleName()));
        if (in_array($module, array_keys($this->_mc))) {
            if (in_array($controller, array_keys($this->_mc[$module]))) {
                if ($this->_mc[$module][$controller] == '*' || in_array($action, array_filter(explode(',', $this->_mc[$module][$controller])))) {
                    return true;
                }
            }
        }

        return false;
    }


    protected function after() {
        $info = \Business\Login::getInstance()->getLoginUser();
        $this->assign('adminUser',$info);
    }

    /**
     * @return \MongoClient
     * @throws \Exception
     * 
     */
    public function getMongo() {
        $mongodb = \Yaf\Registry::get('mongodb');
        return $mongodb;
    }

    /**
     * 
     * @return \Redis
     * @throws \Exception
     */
    public function getRedis() {
        $redis = \Yaf\Registry::get('redis');
        return $redis;
    }

    /**
     * 创建校验码
     * @param array $params
     * @return string
     */
    protected function createSignature($params) {
        $codeArr = array();
        foreach ($params as $key => $value) {
            $codeArr[$key] = $key . '=' . $value;
        }
        ksort($codeArr);
        $config = \Yaf\Registry::get('config');
        return md5(implode('', $codeArr) . $config->get('encryption.appsecret'));
    }

    protected function getToken($input = array()) {
        $request = $this->getRequest();
        $server = $request->getServer();
        $ip = \Ku\Tool::getClientIp();
        $data['ua'] = !isset($server['HTTP_USER_AGENT'])? : $server['HTTP_USER_AGENT'];
        $data['ip'] = $ip;
        if ($input) {
            $data = array_merge($data, $input);
        }
        return $this->createSignature($data);
    }
}
