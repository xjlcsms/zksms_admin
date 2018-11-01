<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/6/30
 * Time: 10:25
 */
namespace M\Mapper;

class SmsUser extends \M\Mapper\MapperAbstract
{

    use \M\Instance;

    protected $modelClass = '\M\SmsUser';

    protected $table = 'sms_user';

}