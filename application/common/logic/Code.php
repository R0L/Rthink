<?php

namespace application\common\logic;
use application\common\model\Code as CodeModel;
use think\Config;
/**
 * @author ROL
 * @date 2016-11-21 16:10:54
 * @version V1.0
 * @desc   
 */
class Code{
    
    
    /**
     * 验证验证码
     * @param type $mobile
     * @param type $code
     * @return boolean
     */
    public static function verifiCode($mobile,$code) {
        $_code = CodeModel::where(['mobile'=>$mobile])->order('create_time', 'desc') ->limit(1)->value('code');
        if($_code == $code){
            return true;
        }
        return false;
    }
    
    /**
     * 添加CODE
     * @param type $mobile
     * @param type $code
     * @return type
     */
    public static function addCode($mobile,$code){
        $codeModel = new CodeModel();
        
        $now_start = strtotime(date("Y-m-d"));
        $now_end = strtotime(date("Y-m-d",time()+3600*24*1));
        
        $count = $codeModel->where(["mobile"=>$mobile,"create_time"=>["between",[$now_start,$now_end]]])->count();
        
        
        if(Config::get("CODE_DAY_LIMIT")<=$count){
            
        }
        
        
            CodeModel::all();
        
        
        
        return CodeModel::create(["mobile"=>$mobile,"code"=>$code]);
    }
    
}
