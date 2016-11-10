<?php

namespace application\admin\controller;
use application\admin\model\Notice as NoticeModel;

/**
 * @author ROL
 * @date 2016-11-10 15:40:31
 * @version V1.0
 * @desc   
 */
class Notice extends Admin {
    
    public function index() {
        $map = array();
        $map["status"] = 1;
        $notice_type = trim(input('notice_type'));
        $map["notice_type"] = $notice_type;
        $title = trim(input('title'));
        if (!empty($title)) {
            $map["title|content"] = ["like", "%" . $title . "%"];
        }
        $Notice = new NoticeModel();
        $lists = $Notice->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
}
