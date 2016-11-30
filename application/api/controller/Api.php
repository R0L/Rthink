<?php

namespace application\api\controller;

use application\common\controller\Common;
use think\Request;
use think\Response;
use think\Config;
use think\exception\HttpResponseException;



/**
 * @author ROL
 * @date 2016-11-21 13:49:58
 * @version V1.0
 * @desc   接口访问公有类
 */

class Api extends Common {

    private $appsecret = null;
    private $version = null;
    private $terminal = null;
    private $apptoken = null;
    
    const SUCCESS = 0; //获取成功
    //1XX 客户端异常
    const EXCEPTION = 100;//请求错误
    //2XX 服务器异常
    const ERROR = 200; //异常
    
    /**
     * 初始化
     */
    public function _initialize() {
//        if(empty($this->checkToken(Request::instance()))){
//            $response = Response::create(self::jCode(1100), Config::get('default_ajax_return'));
//            throw new HttpResponseException($response);
//        }
    }
    
    /**
     * 版本控制
     */
    private function versionControl() {
        
    }
    
    /**
     * 生成token
     * @param type $request
     * @return type
     */
    private function createToken($request){
        $param = $request->param();
        $paramValue=[];
        foreach ($param as $key => $value) {
            $paramValue[] = $value;
        }
        
        $paramValue[] = $request->header("pub_id");
        $paramValue[] = $request->header("terminal");
        
        ksort($paramValue);
        
        $map["terminal"] = $request->header("terminal");
        $map["version"] = $request->param("version");
        $time = $request->header("time");
        $apikey = \think\Db::name("token")->field("apikey")->find($map);
        
        return md5(implode("", $paramValue)+$time+$apikey);
    }

    
    /**
     * 检查token符合条件
     * @return type
     */
    private function checkToken($request) {
        $time = $request->header("time");
        if($time>time()){
            return false;
        }
        $serverApptoken = $this->createToken($request);
        $token = $request->header("token");
        if($serverApptoken == $token){
            return true;
        }
        return false;
        
    }
    
    /**
     * 成功操作
     * @param type $message
     * @param type $data
     * @return type
     */
    public static function jSuccess($message="操作成功",$data=[]) {
        if(empty($data)){
            return ["status"=>Api::SUCCESS,"message"=>$message];
        }
        return ["status"=>Api::SUCCESS,"message"=>$message,"data"=>$data];
    }
    /**
     * 客户端异常操作
     * @param type $message
     * @param type $data
     * @return type
     */
    public static function jException($message="操作失败，客户端异常",$data=[]) {
        if(empty($data)){
            return ["status"=>Api::EXCEPTION,"message"=>$message];
        }
        if(is_numeric($data)){
            return ["status"=>Api::EXCEPTION.$data,"message"=>$message];
        }
        return ["status"=>Api::EXCEPTION,"message"=>$message,"data"=>$data];
    }
    /**
     * 服务器异常操作
     * @param type $message
     * @param type $data
     * @return type
     */
    public static function jError($message="操作失败，服务器异常",$data=[]) {
        if(empty($data)){
            return ["status"=>Api::ERROR,"message"=>$message];
        }
        if(is_numeric($data)){
            return ["status"=>Api::ERROR.$data,"message"=>$message];
        }
        return ["status"=>Api::ERROR,"message"=>$message,"data"=>$data];
    }
    
    /**
     * 数据返回
     * @param type $code
     * @param type $message
     * @param type $data
     * @return type
     */
    public static function jCode($code = 0, $message = "", $data = []) {
        $temp["code"] = $code;
        if ($code == 0 && is_numeric($message)) {
            $message = Config::get("code.$message");
        } else {
            $message = Config::get("code.$code").$message;
        }
        $temp["message"] = $message?:"操作成功";
        if(!empty($data)){
            $temp["result"] = $data;
        }
        return $temp;
    }
    
    
    /**
     * 检查mobile
     * @param type $mobile
     * @return type
     */
    protected function checkMobile($mobile) {
        if(empty($mobile)){
            return self::jCode(1101);
        }
        if(!preg_match("/^1[3456789]\d{9}$/",$mobile)){
            return self::jCode(1102);
        }
    }
    
    /**
     * 检查code
     * @param type $code
     * @return type
     */
    protected function checkCode($code) {
        if(empty($code)){
            return self::jCode(1103);
        }
        if(!preg_match("/^\d{4}$/",$code)){
            return self::jCode(1104);
        }
    }
    
    /**
     * 检查userId
     * @param type $userId
     * @return type
     */
    protected function checkUserId($userId) {
        if(empty($userId)){
            return self::jCode(1105);
        }
    }
    
    /**
     * 检查userPassword
     * @param type $password
     * @return type
     */
    protected function checkPassword($password) {
         if(empty($password)){
            return self::jCode(1106);
        }
        if(!preg_match("/^\w{0,10}$/",$password)){
            return self::jCode(1107);
        }
    }
    
    /**
     * 检查nickName
     * @param type $username
     * @return type
     */
    protected function checkUserName($username) {
         if(empty($username)){
            return self::jCode(1108);
        }
        if(!preg_match("/^\w{0,30}$/",$username)){
            return self::jCode(1109);
        }
    }
    
    
    

}
