<?php
namespace application\api\controller;
use application\api\controller\Api;
/**
 * @author ROL
 * @date 2016-11-25 11:38:55
 * @version V1.0
 * @desc   
 */
class Error{
    
    public function index() {
        return Api::jException("请求链接异常，服务器控制器不存在");
    }
    public function _empty() {
        return Api::jException("请求链接异常，服务器操作不存在");
    }
    public function miss() {
        return Api::jException("请求链接异常，服务器不存在该接口");
    }
    
}
