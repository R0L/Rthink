<?php

namespace application\admin\controller;

use application\common\model\User as UserModel;
use think\Request;

/**
 * @author ROL
 * @date 2016-11-10 11:01:35
 * @version V1.0
 * @desc   
 */
class User extends Admin {

    /**
     * 商城用户管理
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $map = array();
        $title = $request->param("title");
        if (!empty($title)) {
            $map["user_name|mobile|email|real_name"] = ["like", "%" . $title . "%"];
        }
        $lists = UserModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    public function add(Request $request) {
        return ;
    }
    
    public function edit(Request $request) {
        return ;
    }

}
