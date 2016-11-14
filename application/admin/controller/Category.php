<?php

namespace application\admin\controller;

use application\admin\model\Category as CategoryModel;
use think\Request;

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
    public function index(Request $request) {
        $map = [];
        $title = $request->param("title");
        if (empty($title)) {
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $lists = CategoryModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * 商品分类编辑或者添加
     * @param Request $request
     * @return type
     */
    public function deal(Request $request) {
        if (request()->isPost()) {
            $deal = CategoryModel::deal($request->param());
            if ($deal) {
                $this->success("操作成功", url("index"));
            }
            $this->error("操作失败");
        } else {
            ($id = input("param.id")) ? $this->assign("info", CategoryModel::getLineData(["id" => $id])) : "";
            return $this->fetch("edit");
        }
    }

    /**
     * 商品分类删除
     * @param Request $request
     */
    public function del(Request $request) {
        $id = array_unique((array) $request->param('param.id/a'), 0);
        empty($id) && $this->error("不存在参数ID");
        $staus_deal = CategoryModel::del(["id" => ["in", $id]]);
        if ($staus_deal) {
            $this->success("操作成功", url("index"));
        }
        $this->error("操作失败");
    }

}
