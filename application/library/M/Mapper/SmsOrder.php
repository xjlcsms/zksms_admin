<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/6/30
 * Time: 10:25
 */
namespace M\Mapper;

class SmsOrder extends \M\Mapper\MapperAbstract
{

    use \M\Instance;

    protected $modelClass = '\M\SmsOrder';

    protected $table = 'sms_order';

    private $_actions = array(1=>'充值',2=>'回退',3=>'发送');

    public function getActions(){
        return $this->_actions;
    }

}