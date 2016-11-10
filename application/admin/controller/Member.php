<?php

namespace application\admin\controller;
use application\admin\model\Member as MemberModel;

/**
 * @author ROL
 * @date 2016-11-10 15:35:56
 * @version V1.0
 * @desc   
 */
class Member extends Admin {
    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if (!empty($title)) {
            $map["recipients|phone"] = ["like", "%" . $title . "%"];
        }
        $Member = new MemberModel();
        $lists = $Member->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
}
