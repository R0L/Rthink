<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-10 15:21:25
 * @version V1.0
 * @desc   
 */
class Slider extends BaseCommon {
    
    //自动完成
    protected $auto = ['update_time'];
    protected $insert = ['status' => 1,'create_time','picture_id'];  
    protected $update = [];  
    
    /**
     * 图片数组到对象的转换
     * @return type
     */
    protected function setPictureIdAttr($picture_id,$data){
        if(empty($picture_id)){
            $picture_id =  $data["picture_id[]"];
        }
        return implode(",", $picture_id);
    }
}
