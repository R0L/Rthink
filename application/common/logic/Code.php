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
     * 更新Code 根据$mobile
     * @param type $data
     * @param type $mobile
     * @return type
     */
    public static function updateToCodeByMobile($data,$mobile){
       return CodeModel::update($data, ["mobile"=>$mobile]);
    }
    
    /**
     * 标志Code使用 根据$mobile
     * @param type $id
     * @return type
     */
    public static function updateToCodeUsered($id) {
        return CodeModel::update(["code_status"=>1], ["id"=>$id]);
    }
    

    /**
     * 获取做新的Code
     * @param type $mobile
     * @return type
     */
    public static function findToNewCode($mobile) {
        return CodeModel::where(['mobile'=>$mobile,"code_status"=>0])->order(['create_time'=>'desc'])->find();
    }
    
    
    /**
     * 添加CODE
     * @param type $mobile
     * @param type $code
     * @return type
     */
    public static function addCode($mobile,$code) {
        return CodeModel::create(["mobile"=>$mobile,"code"=>$code]);
    }
    
    
    
    /**
     * 当天同一手机发送短信数量
     * @param type $mobile
     * @param type $code
     * @return type 
     */
    public static function countByMobile($mobile){
        return CodeModel::whereTime('create_time', 'd')->where(["mobile"=>$mobile])->count();
    }
    
}
