<?php

namespace application\admin\model;

use think\Model;

/**
 * 行为Log模型
 */
class ActionLog extends Base {

     public function user(){
        return $this->hasOne('User',"user_id","id");
    }
    
    
}
