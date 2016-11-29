<?php

namespace application\common\validate;

use think\Validate;

/**
 * @author ROL
 * @date 2016-11-21 15:32:28
 * @version V1.0
 * @desc   
 */
class User extends Validate {

    protected $rule = [
        'user_name' => 'length:2,30|regex:/^\w+$/u',
        'mobile' => 'length:11|regex:/^1[3456789]\d{9}$/',
        'email' => 'email',
    ];
    protected $message = [
        'user_name.length' => '用户帐号长度在2~30字符',
        'user_name.regex' => '用户帐号只支持 英文、数字、下划线',
        'mobile.length' => '用户手机号码长度在11字符',
        'mobile.regex' => '用户手机号码不符合规则',
        'email.email' => '用户邮箱不符合规则',
    ];
    protected $scene = [
    ];

}
