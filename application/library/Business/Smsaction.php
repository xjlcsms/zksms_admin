<?php
/**
 * Created by PhpStorm.
 * User: chendongqin
 * Date: 18-11-11
 * Time: 下午3:53
 */
namespace Business;
final class Smsaction extends \Business\BusinessAbstract
{
    use \Business\Instance;

    /**获取文件的有效手机号码
     * @param $filename
     * @return array|mixed|null
     * @throws \PHPExcel\PHPExcel\Reader_Exception
     */
    public function importMobiles($filename){
        $redis = $this->getRedis();
        $mobilesJson = $redis->get(md5($filename));
        if($mobilesJson !== false){
            $mobiles = json_decode($mobilesJson,true);
        }else{
            try{
                $read = \PHPExcel\IOFactory::createReader('Excel2007');
                $obj = $read->load(APPLICATION_PATH.'/public/uploads/sms/'. $filename);
                $dataArray =$obj->getActiveSheet()->toArray();
                $mobiles = [];
                unset($dataArray[0]);
                foreach ($dataArray as $key=> $item){
                    if(\Ku\Verify::isMobile($item[0])){
                        $mobiles[] = $item[0];
                    }
                }
                $mobiles = array_unique($mobiles);
            }catch (\ErrorException $errorException){
                $mobiles = null;
            }
        }
        return $mobiles;
    }


    /**账户验证
     * @param \M\SmsUser $user
     * @param $chanel
     * @param $sendTotal
     * @return bool
     */
    public function virefy(\M\SmsUser $user,$chanel,$sendTotal){
        $sendTypes = \M\Mapper\SmsTask::$sendTypes;
        if(!isset($sendTypes[$chanel])){
            return $this->getMsg(1254,'短信参数错误');
        }
        $account = \M\Mapper\SmsAccount::getInstance()->findByUserId($user->getId());
        $str = 'get'.ucfirst($chanel);
        if($account->$str() < $sendTotal){
            return $this->getMsg(1255,'用户的'.$sendTypes[$chanel].'短信余额不足');
        }
        return true;
    }

    /**手机短信批量发送
     * @param $mobiles
     * @return array
     */
    public function divideMobiles($mobiles){
        $count = count($mobiles);
        $data = [];
        if($count<=100){
            $data[] =  $mobiles;
        }else{
            $total = ceil($count / 500);
            for ($i=0;$i<$total;$i++){
                $begin = $i*500;
                $data[] = array_slice($mobiles,$begin,500);
            }
        }
        return $data;
    }


    /**发送短信总费用
     * @param array $mobiles
     * @param $content
     * @return int
     */
    public function totalFee(array $mobiles,$content){
        $count = count($mobiles);
        $strlen = mb_strlen($content);
        if($strlen>70){
            $totalfee = (ceil($strlen/67))*$count;
        }else{
            $totalfee = $count;
        }
        return (int)$totalfee;
    }

    /**短信收费
     * @param $content
     * @return int
     */
    public function oneFee($content){
        $strlen = mb_strlen($content);
        if($strlen>70){
            $fee = ceil($strlen/67);
        }else{
            $fee = 1;
        }
        return (int)$fee;
    }

    /**根据到达率产生随机发送的手机号
     * @param \UsersModel $user
     * @param $mobiles
     * @return array
     */
    public function trueMobiles(\UsersModel $user , $mobiles){
        if($user->getArrival_rate() == 100){
            $data['true'] = $mobiles;
            $data['fail'] = null;
        }elseif($user->getArrival_rate()==0){
            $data['true'] = null;
            $data['fail'] = $mobiles;
        }else{
            shuffle($mobiles);
            $len = ceil(count($mobiles)*($user->getArrival_rate()/100));
            $data['true'] = array_slice($mobiles,0,$len);
            $data['fail'] = array_slice($mobiles,$len);
        }

        return $data;
    }

}