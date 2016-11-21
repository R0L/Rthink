<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-10 10:18:08
 * @version V1.0
 * @desc   
 */
class AuthGroupAccess extends \think\Model {
    
    public function member(){
        return $this->belongsTo('Member',"uid","id");
    }
    
}
