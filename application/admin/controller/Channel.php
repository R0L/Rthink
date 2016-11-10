<?php

namespace application\admin\controller;

use application\admin\model\Channel as ChannelModel;

/**
 * @author ROL
 * @date 2016-11-10 11:33:17
 * @version V1.0
 * @desc   
 */
class Channel extends Admin {
    
    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if (!empty($title)) {
            $map["recipients|phone"] = ["like", "%" . $title . "%"];
        }
        $Channel = new ChannelModel();
        $lists = $Channel->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
}
