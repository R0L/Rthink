<?php

namespace application\admin\controller;
use application\common\model\Member as MemberModel;
use think\Request;
/**
 * @author ROL
 * @date 2016-11-10 15:35:56
 * @version V1.0
 * @desc   
 */
class Member extends Admin {
    
    /**
     * 后台管理员列表展示
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $map = array();
        $title = $request->param("title");
        if ($title) {
            $map["recipients|phone"] = ["like", "%" . $title . "%"];
        }
        $lists = MemberModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    
    /**
     * 后台管理员的编辑或者添加
     * @param Request $request
     * @return type
     */
    public function deal(Request $request) {
        if($request->isPost()){
            $statusDeal = MemberModel::deal($request->param());
            if($statusDeal){
                $this->success("操作成功");
            }
            $this->error("操作失败");
        }
        $this->assign("info", ["pid"=>$request->user->id]);
        return $this->fetch("edit");
    }
}
