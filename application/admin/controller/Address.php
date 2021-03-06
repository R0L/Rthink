<?php

namespace application\admin\controller;

use application\common\model\UserAddress;
use application\common\model\Amap;

use think\Request;

/**
 * @author ROL
 * @date 2016-11-10 11:33:17
 * @version V1.0
 * @desc   
 */
class Address extends Admin {
    
    public function index() {
        $map = [];
        $title = trim(input('title'));
        if (!empty($title)) {
            $map["recipients|phone"] = ["like", "%" . $title . "%"];
        }
        $lists = UserAddress::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    public function manage(Request $request) {
        $lists = Amap::paginate($request->except("page"));
        $this->assign('lists', $lists);
        return $this->fetch();
    }
}
