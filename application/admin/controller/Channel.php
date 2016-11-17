<?php

namespace application\admin\controller;

use application\admin\model\Channel as ChannelModel;
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
     * @return type
     */
    public function add(Request $request) {
        return $this->deal($request);
    }

    /**
     * 导航编辑
     * @param Request $request
     * @return \application\admin\controller\type
     */
    public function edit(Request $request) {
        return $this->deal($request);
    }

    /**
     * 导航删除
     * @param Request $request
     */
    public function del(Request $request) {
        $delByIds = ChannelModel::delByIds($request->param("id/a"));
        if ($delByIds) {
            $this->success("操作成功", "index");
        }
        $this->error("操作失败");
    }

    /**
     * 导航管理编辑或者添加
     * @param Request $request
     * @return type
     */
    private function deal(Request $request) {
        if ($request->isPost()) {
            $statusDeal = ChannelModel::deal($request->param());
            if ($statusDeal) {
                $this->success("操作成功", "index");
            }
            $this->error("操作失败");
        }
        $id = $request->param("id");
        if ($id) {
            $channelGet = ChannelModel::getLineData(["id" => $id]);
            $this->assign("info", $channelGet);
        } else {
            $this->assign("info", ["member_id" => $request->user->id, "pub_id" => $request->pubuser->id]);
        }
        return $this->fetch("edit");
    }

}
