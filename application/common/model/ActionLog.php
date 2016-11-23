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

}
