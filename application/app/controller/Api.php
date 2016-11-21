<?php

namespace application\app\controller;

use think\Controller;
use think\Cache;
use think\Request;

/**
 * @author ROL
 * @date 2016-11-21 13:49:58
 * @version V1.0
 * @desc   接口访问公有类
 */
class Api extends Controller {

    private $appid = null;
    private $appsecret = null;
    
    const SUCCESS = 200; //获取成功
    const EXCEPTION = 400; //异常
    const EXCEPTION_TOKEN = 401; //令牌异常
    const ERROR = 500; //服务器错误
    
    /**
     * 初始化
     */
    public function _initialize() {
        $resquest = Request::instance();
        if(!$this->checkToken($resquest->param("token"))){
            return ["code"=>Api::EXCEPTION_TOKEN,"message"=>"令牌异常"];
        }
    }
    
    
    /**
     * 获取Token
     */
    public function getToken() {
        $resquest = Request::instance();
        $this->appid = $resquest->param("appid");
        $this->appsecret = $resquest->param("appsecret");
        
        $ori_str = Cache::get($this->appid . '_' . $this->appsecret);
        if ($ori_str) { 
             Cache::set($ori_str, null);
        }
        $nonce = $this->createNoncestr();
        $tmpArr = array($nonce, $this->appid, $this->appsecret);
        sort($tmpArr, SORT_STRING);
        $tmpStr = sha1(implode($tmpArr));
        Cache::set($this->appid . '_' . $this->appsecret, $tmpStr, 7200);
        Cache::set($tmpStr, $this->appid . '_' . $this->appsecret, 7200);
        return ["code"=>  Api::SUCCESS,"message"=>"获取成功","data"=>$tmpStr];
    }

    
    /**
     * 检查token符合条件
     * @param type $token
     * @return boolean
     */
    public function checkToken($token) {
        if(Cache::get(Cache::get($token)) == $token){
            return true;
        }
        return false;
    }
    
    /**
     * 产生随机字符串，不长于32位
     * @param type $length
     * @return type
     */
    function createNoncestr($length = 32) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str.= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}
