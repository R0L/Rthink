<?php

namespace application\index\controller;

use \think\Controller;

class Base extends Controller {

    public function _empty() {
        echo "操作不存在";
    }

}
