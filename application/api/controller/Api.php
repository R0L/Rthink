<?php

namespace application\api\controller;

use application\common\controller\Common;
use think\Request;
use think\config;



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
        $resquest = Request::instance();
        
        $resquest->param(["pub_id"=>1]);
        
//        $param = $resquest->param("pub_id");
        
//        $this->terminal = $resquest->param("terminal");
//        if(empty($this->terminal)){
//            return ["code"=>Api::EXCEPTION,"message"=>"缺少终端类型"];
//        }
//        $this->apptoken = $resquest->param("apptoken");
//        if(empty($this->apptoken)){
//            return ["code"=>Api::EXCEPTION,"message"=>"缺少token"];
//        }
//        $this->version = $resquest->param("version",0);
//        $map["terminal"] = $this->terminal;
//        empty($this->version) || $map["version"] = $this->version;
//        $version = $this->checkToken();
//        if($version){
//            return ["code"=>Api::EXCEPTION,"message"=>"token错误"];
//        }
//        $this->version = $version;
    }
    
    /**
     * 版本控制
     */
    private function versionControl() {
        
    }

    
    /**
     * 检查token符合条件
     * @return type
     */
    private function checkToken() {
        
        $findToken = \think\Db::name("token")->order(["version","desc"])->find($map);
        
        $serverApptoken = md5(date("Y-m-d",time()).$findToken["appsecret"].$this->version);
        
        if($serverApptoken == $this->apptoken){
            return $findToken["version"];
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
     * @param type $data
     * @param type $message
     * @return type
     */
    public static function jCode($code = 0, $message = "", $data = []) {
        $data["code"] = $code;
        if ($code == 0 && is_numeric($message)) {
            $message = Config::get("code.$message");
        } else {
            $message = Config::get("code.$code").$message;
        }
        $data["message"] = $message?:"操作成功";
        if(empty($data)){
            $data["data"] = $data;
        }
        return $data;
    }
    
    
    /**
     * 检查mobile
     * @param type $mobile
     * @return type
     */
    protected function checkMobile($mobile) {
        if(empty($mobile)){
            return parent::jCode(1101);
        }
        if(!preg_match("/^1[3456789]\d{9}$/",$mobile)){
            return parent::jCode(1102);
        }
    }
    
    /**
     * 检查code
     * @param type $code
     * @return type
     */
    protected function checkCode($code) {
        if(empty($code)){
            return parent::jCode(1103);
        }
        if(!preg_match("/^\d{4}$/",$code)){
            return parent::jCode(1104);
        }
    }
    
    /**
     * 检查userId
     * @param type $userId
     * @return type
     */
    protected function checkUserId($userId) {
        if(empty($userId)){
            return parent::jCode(1105);
        }
    }
    
    /**
     * 检查userPassword
     * @param type $password
     * @return type
     */
    protected function checkPassword($password) {
         if(empty($password)){
            return parent::jCode(1106);
        }
        if(!preg_match("/^\w{0,10}$/",$password)){
            return parent::jCode(1107);
        }
    }
    
    
    

}
