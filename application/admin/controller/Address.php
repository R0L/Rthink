<?php

namespace application\admin\controller;

use application\admin\model\UserAddress;

/**
 * @author ROL
 * @date 2016-11-10 11:33:17
 * @version V1.0
 * @desc   
 */
class Address extends Admin {
    
    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if (!empty($title)) {
            $map["recipients|phone"] = ["like", "%" . $title . "%"];
        }
        $UserAddress = new UserAddress();
        $lists = $UserAddress->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
}
