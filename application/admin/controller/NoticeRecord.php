<?php

namespace application\admin\controller;
use application\common\model\NoticeRecord as NoticeRecordModel;
/**
 * @author ROL
 * @date 2016-11-10 15:56:19
 * @version V1.0
 * @desc   
 */
class NoticeRecord extends Admin {
    public function index() {
        $map = [];
//        $title = trim(input('title'));
//        if (!empty($title)) {
//            $map["title|content"] = ["like", "%" . $title . "%"];
//        }
        $lists = NoticeRecordModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
}
