<?php

namespace application\api\controller;

use application\common\controller\Common;
use think\Request;



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
        $this->terminal = $resquest->param("terminal");
        if(empty($this->terminal)){
            return ["code"=>Api::EXCEPTION,"message"=>"缺少终端类型"];
        }
        $this->apptoken = $resquest->param("apptoken");
        if(empty($this->apptoken)){
            return ["code"=>Api::EXCEPTION,"message"=>"缺少token"];
        }
        $this->version = $resquest->param("version",0);
        $map["terminal"] = $this->terminal;
        empty($this->version) || $map["version"] = $this->version;
        $version = $this->checkToken();
        if($version){
            return ["code"=>Api::EXCEPTION,"message"=>"token错误"];
        }
        $this->version = $version;
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
}
