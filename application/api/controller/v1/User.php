<?php

namespace application\api\controller\v1;
use application\api\controller\UserAbstract;
use application\common\service\User as UserService;
/**
 * @author ROL
 * @date 2016-11-25 15:28:20
 * @version V1.0
 * @desc 用户相关模块   
 */
class User extends UserAbstract {
    
    /**
     * 用户服务接口
     * @var type 
     */
    private $user = null;
    
    /**
     * 构造函数
     */
    function _initialize() {
        $this->user = new UserService();
    }

    public function sendSms($mobile, $opType = 0, $sendType = 0) {
        if(empty($mobile)){
            return parent::jException("缺少手机号码");
        }
        if(!preg_match("/^1[3456789]\d{9}$/",$mobile)){
            return parent::jException("手机号码不符合规则");
        }
        $this->user->sendSms($mobile, $opType, $sendType);
        return $pub_id;
    }

}
