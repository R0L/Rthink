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
       if($request->isPost()){
           $this->opReturn(LinkModel::create($request->param()));
        }
        return $this->fetch("edit");
    }
    
    
    /**
     * 编辑友情链接
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        if($request->isPost()){
           $this->opReturn(LinkModel::update($request->param()));
        }
        $this->assign("info", LinkModel::get($request->param("id")));
        return $this->fetch("edit");
    }
    
    
    /**
     * 友情链接删除
     * @param Request $request
     */
    public function del(Request $request) {
        $this->opReturn(LinkModel::delByIds($request->param("id/a")));
    }
    
}
