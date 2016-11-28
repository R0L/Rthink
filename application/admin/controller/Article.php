<?php

namespace application\admin\controller;

use think\Request;
use application\common\model\Article as ArticleModel;

/**
 * @author ROL
 * @date 2016-11-18 16:02:43
 * @version V1.0
 * @desc   
 */
class Article extends Admin {

    /**
     * 文章列表展示
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $map = [];
        if ($title = $request->param("title")) {
            $map["title|content"] = $title;
        }
        $lists = ArticleModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * 添加文章
     * @param Request $request
     * @return type
     */
    public function add(Request $request) {
        if ($request->isPost()) {
            $this->opReturn(ArticleModel::create($request->param()), "Article/index");
        }
        return $this->fetch("edit");
    }

    /**
     * 编辑文章
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        if ($request->isPost()) {
            $this->opReturn(ArticleModel::update($request->param()));
        }
        $articleGet = ArticleModel::get($request->param("id"));
        $this->assign("info", $articleGet);
        return $this->fetch("edit");
    }

    /**
     * 文章删除
     * @param Request $request
     */
    public function del(Request $request) {
        $this->opReturn(ArticleModel::delByIds($request->param("id/a")));
    }

}
