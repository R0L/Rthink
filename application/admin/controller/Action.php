<?php

namespace application\admin\controller;

use application\admin\logic\ActionLog;
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
    
    /**
     * 清空行为日志
     * @param Request $request
     */
    public function clear(Request $request) {
        $statusClear = ActionLog::del(["status"=>1]);
        if($statusClear){
            $this->success("操作成功");
        }
        $this->error("操作失败");
    }
    
    /**
     * 行为日志删除
     * @param Request $request
     */
    public function del(Request $request) {
        $statusDel = ActionLog::del(["id"=>["in",$request->param("ids/a")]]);
        if($statusDel){
            $this->success("操作成功");
        }
        $this->error("操作失败");
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
