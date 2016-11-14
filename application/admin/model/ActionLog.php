<?php
namespace application\admin\model;

/**
 * 行为Log模型
 */
class ActionLog extends Base {

     public function user(){
        return $this->hasOne('User',"user_id","id");
    }
    
     public function action(){
        return $this->belongsTo('Action',"action_id","id");
    }
    
}
