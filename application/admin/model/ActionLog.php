<?php
namespace application\admin\model;

/**
 * 行为Log模型
 */
class ActionLog extends Base {
    
     public function user(){
        return $this->hasOne('application\admin\model\User',"user_id","id");
    }
    
     public function action(){
        return $this->belongsTo('application\admin\model\Action',"action_id","id");
    }
    
}
