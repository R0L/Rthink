<?php

namespace application\admin\controller;
use think\Controller;
/**
 * @author ROL
 * @date 2016-10-29 11:55:16
 * @version V1.0
 * @desc   
 */
class Index extends Controller {

    public function login() {
        return $this->fetch("user/login");
    }

}
