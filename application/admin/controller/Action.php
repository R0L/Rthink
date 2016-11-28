<?php

namespace application\admin\controller;

use application\common\model\ActionLog;
use think\Request;

/**
 * 行为控制器
 */
class Action extends Admin {

    /**
     * 行为日志列表
     */
    public function index(Request $request) {
        $map = [];
        $title = $request->param("title");
        $title && $map["remark"] = ["like", "%" . $title . "%"];
        $lists = ActionLog::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch("actionLog");
    }
    
    /**
     * 清空行为日志
     * @param Request $request
     */
    public function clear(Request $request) {
        $this->opReturn(ActionLog::del());
    }
    
    /**
     * 行为日志删除
     * @param Request $request
     */
    public function del(Request $request) {
        $this->opReturn(ActionLog::delByIds($request->param("ids/a")));
    }
    
    /**
     * 导出行为日志列表
     * @param Request $request
     */
    public function import(Request $request) {
        $selectToActionLog = ActionLog::selectToActionLog($request->param("ids/a"));
        create_xls($selectToActionLog,"行为日志列表".date("Y-m-d H:i:s").".xls");
    }

}
