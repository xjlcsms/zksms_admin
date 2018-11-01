<?php

class LogoutController extends \Base\ApplicationController {

    /**
     * 自动开启视图引擎及布局模块
     *
     * @var boolean
     */
    protected $autoRender = false;
    protected $autoLayout = false;

    public function indexAction() {
        \Business\Login::getInstance()->logout();
        $this->redirect('/login');
        return false;
    }

}
