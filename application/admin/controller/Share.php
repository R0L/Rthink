<?php

namespace application\admin\controller;

use application\common\model\Share as ShareModel;

/**
 * @author ROL
 * @date 2016-11-10 11:33:17
 * @version V1.0
 * @desc   
 */
class Share extends Admin {
    
    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if (!empty($title)) {
            $map["title|content"] = ["like", "%" . $title . "%"];
        }
        $Share = new ShareModel();
        $lists = $Share->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
}
