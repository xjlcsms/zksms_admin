<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/6/30
 * Time: 10:25
 */
namespace M\Mapper;

class SmsTask extends \M\Mapper\MapperAbstract
{

    use \M\Instance;

    protected $modelClass = '\M\SmsTask';

    protected $table = 'sms_task';

    static $sendTypes = array('code'=>'验证码','normal'=>'通知','market'=>'营销');




}