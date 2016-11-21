<?php

namespace application\admin\controller;

use application\common\model\Brand as BrandModel;
use application\common\model\Category;
use think\Request;

/**
 * @author ROL
 * @date 2016-11-8 14:50:08
 * @version V1.0
 * @desc   
 */
class Brand extends Admin {

    /**
     * 品牌列表展示页面
     * @return type
     */
    public function index(Request $request) {
        $map = [];
        if ($title = $request->param("title")) {
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $lists = BrandModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * 品牌添加
     * @param Request $request
     * @return type
     */
    public function add(Request $request) {
        return $this->deal($request);
    }

    /**
     * 品牌编辑
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        return $this->deal($request);
    }

    /**
     * 品牌操作
     * @param Request $request
     * @return type
     */
    private function deal(Request $request) {
        $Brand = new BrandModel();
        if (request()->isPost()) {
            if ($Brand->deal(input())) {
                $this->success("操作成功", "index");
            }
            $this->error("操作失败:" . $Brand->getError());
        } else {

            //返回终极栏目
            $Category = new Category();
            $this->assign("categorys", $Category->getLastLevelCategory());

            ($id = input("param.id")) ? $this->assign("info", $Brand->get($id)) : "";
            return $this->fetch("edit");
        }
    }

    /**
     * 品牌删除
     * @param Request $request
     */
    public function del(Request $request) {
        $id = array_unique((array) input('param.id/a'), 0);
        empty($id) && $this->error("不存在参数ID");
        $Brand = new BrandModel();
        $staus_deal = $Brand->save(["status" => -1], ["id" => ["in", $id]]);
        if ($staus_deal) {
            $this->success("操作成功", url("index"));
        }
        $this->error("操作失败:" . $Brand->getError());
    }

}
