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

//    /**
//     * 导航删除
//     * @param Request $request
//     */
//    public function del(Request $request) {
//        $delByIds = ChannelModel::delByIds($request->param("id/a"));
//        if ($delByIds) {
//            $this->success("操作成功", "index");
//        }
//        $this->error("操作失败");
//    }

    /**
     * 导航管理编辑或者添加
     * @param Request $request
     * @return type
     */
    public function deal(Request $request) {
        if ($request->isPost()) {
            $dealModel = ChannelModel::deal($request->param());
            if ($dealModel->getError()) {
                $this->error("操作失败:".$dealModel->getError());
            }
            $this->success("操作成功", "Channel/index");
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
