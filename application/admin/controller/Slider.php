<?php

namespace application\admin\controller;
use application\admin\model\Slider as SliderModel;

/**
 * @author ROL
 * @date 2016-11-10 15:20:09
 * @version V1.0
 * @desc   
 */
class Slider  extends Admin{
    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if (!empty($title)) {
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $Slider = new SliderModel();
        $lists = $Slider->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
}
