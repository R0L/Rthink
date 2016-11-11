<?php

namespace application\admin\validate;

/**
 * @author ROL
 * @date 2016-11-11 11:23:12
 * @version V1.0
 * @desc   
 */
class Member extends Base {
    protected $rule = [
        'user_name'=>'require|length:0,30|unique:member',
        'password'=>'require|length:0,10',
    ];
    protected $message = [
        'title.require'=>'用户帐号不能为空',
        'title.length'=>'用户帐号长度在0-30',
        'title.unique'=>'用户帐号不唯一',
        'password.require'=>'用户密码不能为空',
        'password.length'=>'用户密码长度在0-10',
    ];
    
    protected $scene = [
        
    ];
}
