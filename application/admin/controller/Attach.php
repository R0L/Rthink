<?php

namespace application\admin\controller;
use think\Request;
use application\admin\model\Picture;
/**
 * @author ROL
 * @date 2016-11-17 13:32:53
 * @version V1.0
 * @desc   
 */
class Attach extends Admin {
    
    
    public function picture(Request $request) {
        $lists = Picture::paginate($request->except("page"));
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
}
