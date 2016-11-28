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
     * 后台管理员的添加
     * @param Request $request
     * @return type
     */
    public function add(Request $request) {
        if($request->isPost()){
            $this->opReturn(MemberModel::create($request->param()));
        }
        $this->assign("info", ["pid"=>$request->user->id]);
        return $this->fetch("edit");
    }
    
    /**
     * 后台管理员的编辑
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        if($request->isPost()){
            $this->opReturn(MemberModel::edit($request->param()));
        }
        $this->assign("info", ["pid"=>$request->user->id]);
        return $this->fetch("edit");
    }
    
    /**
     * 后台管理员的删除
     * @param Request $request
     * @return type
     */
    public function del(Request $request) {
        $this->opReturn(MemberModel::delByIds($request->param("id/a")));
    }
}
