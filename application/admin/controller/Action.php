<?php

namespace application\admin\controller;

use application\admin\model\ActionLog;
use think\Request;

/**
 * 行为控制器
 */
class Action extends Admin {

    /**
     * 行为日志列表
     */
    public function actionLog(Request $request) {
        $map = [];
        $title = $request->param("title");
        $title && $map["remark"] = ["like", "%" . $title . "%"];
        $lists = ActionLog::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    public function clear() {
        return true;
    }

}
