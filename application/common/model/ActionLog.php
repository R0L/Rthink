<?php

namespace application\common\model;

/**
 * 行为Log模型
 */
class ActionLog extends BasePub {

    //自动完成
    protected $auto = [];
    protected $update = [];

    // 定义全局的查询范围
    protected function base($query) {
        parent::base($query);
        $query->order(["create_time" => "DESC"]);
    }

    /**
     * 日志记录中的用户信息
     * @return type
     */
    public function user() {
        return $this->hasOne('application\common\model\User', "user_id", "id");
    }

    /**
     * 日志记录中的日志类型
     * @return type
     */
    public function action() {
        return $this->belongsTo('application\common\model\Action', "action_id", "id");
    }
    
    
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

}
