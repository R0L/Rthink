<?php

namespace application\admin\controller;
use think\Request;
use application\common\logic\AuthRule as AuthRuleLogic;
use application\common\service\Meun;


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
    
    /**
     * 菜单添加
     * @param Request $request
     * @return type
     */
    public function add(Request $request){
        return  $this->deal($request);
    }
    
    /**
     * 菜单编辑
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        return  $this->deal($request);
    }
    
    /**
     * 菜单删除
     * @param Request $request
     */
    public function del(Request $request) {
        $delByIds = AuthRuleLogic::delByIds($request->param("id/a"));
        if ($delByIds) {
            $this->success("操作成功");
        }
        $this->success("操作失败");
    }

    /**
     * 菜单编辑或添加
     * @param Request $request
     * @return type
     */
    private function deal(Request $request) {
        if($request->isPost()){
            $statusDeal = AuthRuleLogic::deal($request->param());
            if($statusDeal){
                $this->success("操作成功","index");
            }
            $this->success("操作失败");
        }
        $id = $request->param("id");
        if($id){
            $authRuleGet = AuthRuleLogic::getLineData(["id"=>$id]);
            $this->assign("info", $authRuleGet);
        }else{
            $this->assign("info", ["pid"=>0]);
        }
        $meun = Meun();
        $this->assign('menus',$meun->selectToMenus());
        return $this->fetch('edit');
    }
}
