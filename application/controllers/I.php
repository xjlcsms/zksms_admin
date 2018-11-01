<?php
class iController extends \Base\AbstractController
{
    
    /**
     * 自动开启视图引擎及布局模块
     *
     * @var boolean
     */
    protected $autoRender = false;
    protected $autoLayout = false;
    public function indexAction()
    {
    }
    
    /**
     * 展示验证码图片
     */
    public function captchaAction()
    {
         $channel = $this->getParam('channel',null);
        $limitKey = 'user.resource.captchalimit.' . \Ku\Tool::getClientIp(true);
        
        if ($this->useLimit($limitKey, 10, 60) === true) {
            sleep(3);
        }
        $userKey = sprintf(\Ku\Consts::USING_CAPTCHA_CHANNEL,$channel);
        $userKeyTime = sprintf(\Ku\Consts::USING_CAPTCHA_CHANNEL_TIME,$channel);
        
        $captcha = \Ku\Captcha\Captcha::getInstance();
        $captcha->setHeight(40)->setWidth(98);
        $captcha->setInterfere('pixel')->setRandLength(4)->create();
        $captchVal = $captcha->getCaptcha();
        $session = \Yaf\Session::getInstance();       
        $session->set($userKey, $captchVal);
        //一个验证码有验证次数限制，超过会被要求刷新
        $session->set($userKeyTime,0);
        $captcha->show();
        return false;
    }

}
