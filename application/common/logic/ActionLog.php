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
     * 根据用户id数组返回actionlog
     * @param type $ids
     * @return type
     */
    public static function selectToActionLog($ids = []) {
        $data = [];
        $data[]=["编号","行为名称","记录信息","执行IP","执行时间"];
        $actionLogs = ActionLogModel::all($ids);
        foreach ($actionLogs as $actionLog) {
            $data[]=[$actionLog->id,$actionLog->action->title,$actionLog->remark,$actionLog->action_ip,$actionLog->create_time_fromat];
        }
        return $data;
    }
    
    
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
