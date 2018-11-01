<?php
/**
 * Created by PhpStorm.
 * User: Viter
 * Date: 2018/6/30
 * Time: 10:25
 */
namespace M\Mapper;

class SmsAccount extends \M\Mapper\MapperAbstract
{

    use \M\Instance;

    protected $modelClass = '\M\SmsAccount';

    protected $table = 'sms_account';



}