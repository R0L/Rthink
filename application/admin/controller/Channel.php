<?php

namespace application\admin\controller;

use application\common\model\Channel as ChannelModel;
use think\Request;

/**
 * @author ROL
 * @date 2016-11-10 11:33:17
 * @version V1.0
 * @desc   
 */
class Channel extends Admin {

    /**
     * 导航管理的列表展示页面
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $map = [];
        if ($title = $request->param("title")) {
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $lists = ChannelModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * 导航添加
     * @param Request $request
     */
    public function add(Request $request) {
        if ($request->isPost()) {
            $this->opReturn(ChannelModel::create($request->param()));
        }
        return $this->fetch("edit");
    }
    /**
     * 导航编辑
     * @param Request $request
     */
    public function edit(Request $request) {
        if ($request->isPost()) {
            $this->opReturn(ChannelModel::update($request->param()));
        }
        $this->assign("info", ChannelModel::get($request->param("id")));
        return $this->fetch("edit");
    }
    
    /**
     * 导航删除
     * @param Request $request
     */
    public function del(Request $request) {
        $this->opReturn(ChannelModel::delByIds($request->param("id/a")));
    }
}
