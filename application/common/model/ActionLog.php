<?php
namespace application\common\model;

/**
 * 行为Log模型
 */
class ActionLog extends Base {
    
     public function user(){
        return $this->hasOne('application\common\model\User',"user_id","id");
    }
    
     public function action(){
        return $this->belongsTo('application\common\model\Action',"action_id","id");
    }
    
}
