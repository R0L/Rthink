<?php

namespace application\common\logic;
use application\common\model\Code as CodeModel;
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
        return CodeModel::create(["mobile"=>$mobile,"code"=>$code]);
    }
    
}
