<?php

namespace application\admin\controller;

use application\admin\model\Category as CategoryModel;

/**
 * @author ROL
 * @date 2016-11-8 9:38:18
 * @version V1.0
 * @desc   
 */
class Category extends Admin {

    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 商品分类展示页面
     * @return type
     */
    public function index() {
        $title = trim(input('title'));
        $page = trim(input('page'));
        $Category = new CategoryModel();
        $lists = $Category->where(["status" => 1, "title" => ["like", "%" . $title . "%"]])->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    public function deal() {
        $Category = new CategoryModel();
        if (request()->isPost()) {
            if ($Category->deal(input())) {
                $this->success("操作成功", url("index"));
            }
            $this->error("操作失败:" . $Category->getError());
        } else {
            ($id = input("param.id")) ? $this->assign("info", $Category->get($id)) : "";
            return $this->fetch("edit");
        }
    }

    public function del() {
        $id = array_unique((array) input('param.id/a'), 0);
        empty($id) && $this->error("不存在参数ID");
        $Category = new CategoryModel();
        $staus_deal = $Category->save(["status" => -1], ["id" => ["in", $id]]);
        if ($staus_deal) {
            $this->success("操作成功", url("index"));
        }
        $this->error("操作失败:" . $Category->getError());
    }

}
