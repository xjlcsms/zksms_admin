<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/6/30
 * Time: 10:25
 */
namespace M\Mapper;

class SmsQueue extends \M\Mapper\MapperAbstract
{

    use \M\Instance;

    protected $modelClass = '\M\SmsQueue';

    protected $table = 'sms_queue';

}