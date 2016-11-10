<?php

namespace application\admin\controller;

use application\admin\model\User as UserModel;

/**
 * @author ROL
 * @date 2016-11-10 11:01:35
 * @version V1.0
 * @desc   
 */
class User extends Admin {

    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if (!empty($title)) {
            $map["user_name|mobile|email|real_name"] = ["like", "%" . $title . "%"];
        }
        $User = new UserModel();
        $lists = $User->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }

}
