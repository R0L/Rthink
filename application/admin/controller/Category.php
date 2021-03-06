<?php

namespace application\admin\controller;

use application\common\model\Category as CategoryModel;
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
        $lists = CategoryModel::paginate($map);
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
            $this->opReturn(CategoryModel::create($request->param()));
        }
        $this->assign("category_list",CategoryLogic::selectToCategoryTree());
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
            $this->opReturn(CategoryModel::update($request->param(), ["id"=>$id]));
        } 
        $this->assign("info",CategoryModel::get($id));
        $this->assign("category_list",CategoryLogic::selectToCategoryTree());
        return $this->fetch("edit");
    }
    

    /**
     * 商品分类删除
     * @param Request $request
     */
    public function del(Request $request) {
        $this->opReturn(CategoryModel::delByIds($request->param('id/a')));
    }

}
