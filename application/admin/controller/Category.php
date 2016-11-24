<?php

namespace application\admin\controller;

use application\common\logic\Category as CategoryLogic;
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
        if ($title = $request->param("title")) {
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
        if ($request->isPost()) {
            $categoryLogic = new CategoryLogic();
            $add = $categoryLogic->add($request->param());
            $this->opReturn($add);
        }
        $categoryTree = CategoryLogic::selectToCategoryTree();
        $this->assign("category_list",$categoryTree);
        return $this->fetch("edit");
    }
    
    /**
     * 商品分类编辑
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        $id = $request->param("id");
        if ($request->isPost()) {
            $categoryLogic = new CategoryLogic();
            $edit = $categoryLogic->edit($request->param(), $id);
            $this->opReturn($edit);
        } 
        $categoryGet = CategoryLogic::getLineData($id);
        $this->assign("info",$categoryGet);
        $categoryTree = CategoryLogic::selectToCategoryTree();
        $this->assign("category_list",$categoryTree);
        return $this->fetch("edit");
    }
    

    /**
     * 商品分类删除
     * @param Request $request
     */
    public function del(Request $request) {
        $stausDeal = CategoryLogic::delByIds($request->param('id/a'));
        if ($stausDeal) {
            $this->success("操作成功", "index");
        }
        $this->error("操作失败");
    }

}
