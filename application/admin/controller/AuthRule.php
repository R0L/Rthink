<?php

namespace application\admin\controller;
use think\Request;
use application\admin\logic\AuthRule as AuthRuleLogic;


/**
 * @author ROL
 * @date 2016-11-15 16:09:33
 * @version V1.0
 * @desc   
 */
class AuthRule extends Admin {
    
    /**
     * 后台菜单列表
     */
    public function index(Request $request) {
        $map = [];
        $pid = $request->param("pid", 0);
        $map["pid"] = $pid;
        if (empty($pid)) {
            $data = AuthRuleLogic::get($pid);
            $this->assign('data', $data);
        }
        if($title = $request->param("title")){
            $map["title"] = $title;
        }
        $lists = AuthRuleLogic::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    public function add(Request $request){
        return  $this->deal($request);
    }
    
    private function deal(Request $request) {
        if($request->isPost()){
            
        }
        $id = $request->param("id");
        if($id){
            $authRuleGet = AuthRuleLogic::getLineData(["id"=>$id]);
            $this->assign("info", $authRuleGet);
        }else{
            $this->assign("info", ["id"=>0]);
        }
        $this->assign('menus',AuthRuleLogic::selectToMenus());
        return $this->fetch('edit');
    }
}
