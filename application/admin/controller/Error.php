<?php

namespace application\admin\controller;

/**
 * @author ROL
 * @date 2016-10-29 11:48:16
 * @version V1.0
 * @desc   
 */
class Error{
    
    public function index() {
        return "控制器不存在";
    }
    public function _empty() {
        return "操作不存在";
    }
    public function miss() {
        return "不存在";
    }
    
}
