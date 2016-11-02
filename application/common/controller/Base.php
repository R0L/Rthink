<?php

namespace application\common\controller;
use \think\Controller;

/**
 * @author ROL
 * @date 2016-10-29 11:46:29
 * @version V1.0
 * @desc   
 */
class Base extends Controller {

    //初始化
    public function _initialize() {
    }

    //前置操作
    protected $beforeActionList = [];

    public function _empty() {
        return "操作不存在";
    }

}
