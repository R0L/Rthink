<?php

namespace application\common\logic;
use application\common\model\ActionLog as ActionLogModel;

/**
 * @author ROL
 * @date 2016-11-15 9:48:13
 * @version V1.0
 * @desc   
 */
class ActionLog extends ActionLogModel{
    
    
    /**
     * 统计ActionLog
     * @param type $map
     * @param type $field
     * @return type
     */
    public static function countActionLog($map,$field=null) {
        return ActionModel::where($map)->count($field);
    }
    
}
