<?php
namespace application\common\controller;
/**
 * @author ROL
 * @date 2016-11-25 11:38:55
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
    
}
