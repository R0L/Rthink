<?php

namespace application\api\controller;
/**
 * @author ROL
 * @date 2016-11-25 13:07:25
 * @version V1.0
 * @desc   
 */
abstract class UserAbstract extends Api{
    
    /**
     * 发送短信接口
     */
    abstract function sendSms($mobile,$opType=0,$sendType=0);
    
}
