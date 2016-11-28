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
        if (request()->isPost()) {
            $this->opReturn(BrandModel::create($request->param()));
        }
        //返回终极栏目
        $this->assign("categorys", Category::getLastLevelCategory());
        return $this->fetch("edit");
    }

    /**
     * 品牌编辑
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        if (request()->isPost()) {
            $this->opReturn(BrandModel::update($request->param()));
        }

        //返回终极栏目
        $this->assign("categorys", Category::getLastLevelCategory());
        $this->assign("info", BrandModel::get($request->param("id")));
        return $this->fetch("edit");
    }

    /**
     * 品牌删除
     * @param Request $request
     */
    public function del(Request $request) {
        $this->opReturn(BrandModel::delByIds($request->param('id/a')));
    }

}
