<?php

namespace application\admin\controller;

use application\admin\logic\Category as CategoryLogic;
use think\Request;

/**
 * @author ROL
 * @date 2016-11-8 9:38:18
 * @version V1.0
 * @desc   
 */
class Category extends Admin {


    /**
     * 商品分类展示页面
     * @return type
     */
    public function index(Request $request) {
        $map = [];
        $title = $request->param("title");
        if (empty($title)) {
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $lists = CategoryLogic::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    
    /**
     * 商品分类添加
     * @param Request $request
     * @return type
     */
    public function add(Request $request) {
        return $this->deal($request);
    }
    
    /**
     * 商品分类编辑
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        return $this->deal($request);
    }
    

    /**
     * 商品分类编辑或者添加
     * @param Request $request
     * @return type
     */
    private function deal(Request $request) {
        if ($request->isPost()) {
            $deal = CategoryLogic::deal($request->param());
            if ($deal) {
                $this->success("操作成功", "index");
            }
            $this->error("操作失败");
        } else {
            $id = $request->param("id");
            if($id){
                $categoryGet = CategoryLogic::getLineData($id);
                $this->assign("info",$categoryGet);
            }else{
                $this->assign("info", ["member_id"=>$request->user->id,"pub_id"=>$request->pubuser->id]);
            }
            
            $categoryTree = CategoryLogic::selectToCategoryTree();
            $this->assign("category_list",$categoryTree);
            
            return $this->fetch("edit");
        }
    }

    /**
     * 商品分类删除
     * @param Request $request
     */
    public function del(Request $request) {
        $stausDeal = CategoryLogic::delByIds($request->param('param.id/a'));
        if ($stausDeal) {
            $this->success("操作成功", "index");
        }
        $this->error("操作失败");
    }

}
