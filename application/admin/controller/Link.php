<?php

namespace application\admin\controller;
use think\Request;
use application\common\model\Link as LinkModel;
/**
 * @author ROL
 * @date 2016-11-18 16:02:43
 * @version V1.0
 * @desc   
 */
class Link extends Admin {
    
    
    /**
     * 友情链接列表展示
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $map = [];
        if($title = $request->param("title")){
            $map["title"] = trim($title);
        }
        $lists = LinkModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    
    /**
     * 添加友情链接
     * @param Request $request
     * @return type
     */
    public function add(Request $request) {
       return $this->deal($request);
    }
    
    
    /**
     * 编辑友情链接
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        return $this->deal($request);
    }
    
    
    /**
     * 友情链接删除
     * @param Request $request
     */
    public function del(Request $request) {
        $delByIds = LinkModel::delByIds($request->param("id/a"));
        if(empty($delByIds)){
            $this->error("操作失败");
        }
        $this->success("操作成功");
    }
    
    
    /**
     * 友情链接的编辑或者添加
     * @param Request $request
     * @return type
     */
    private function deal(Request $request) {
        if($request->isPost()){
            $statusDeal = LinkModel::deal($request->param());
            if(empty($statusDeal)){
                $this->error("操作失败");
            }
            $this->success("操作成功","index");
        }
        $id = $request->param("id");
        if($id){
            $articleGet = LinkModel::getLineData($id);
            $this->assign("info", $articleGet);
        }  else {
            $this->assign("info", ["member_id"=>$request->user->id,"pub_id"=>$request->pubuser->id]);
        }
        
        return $this->fetch("edit");
    }
    
    
}
