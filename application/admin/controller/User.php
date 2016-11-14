<?php

namespace application\admin\controller;

use application\admin\model\User as UserModel;
use think\Request;

/**
 * @author ROL
 * @date 2016-11-10 11:01:35
 * @version V1.0
 * @desc   
 */
class User extends Admin {

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

}
