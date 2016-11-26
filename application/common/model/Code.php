<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-21 16:08:36
 * @version V1.0
 * @desc   
 */
class Code extends BasePub {
    
    //自动完成
    protected $insert = [ 'create_time', 'pub_id','code_status'=>Code::CODE_INIT];
    
    const CODE_INIT = 0;//初始化验证码
    const CODE_SEND = 0;//验证码已验证
    
    public static $code_status=[0=>"初始化验证码",1=>"验证码已验证"];
    
    
    
    
    
}
