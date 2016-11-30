<?php

namespace application\common\logic;
use application\common\model\Picture as PictureModel;
/**
 * @author ROL
 * @date 2016-11-29 13:54:45
 * @version V1.0
 * @desc   
 */
class Picture extends PictureModel{
    
    
    /**
     * 获取图片Path 通过$ids
     * @param type $ids
     * @return type
     */
    public static function selectToPathByIds($ids = []) {
       return PictureModel::where(["id"=>["in",$ids]])->column("path");
    }
    
    /**
     * 获取图片Path 通过$id
     * @param type $id
     * @return type
     */
    public static function getPathById($id) {
       return PictureModel::where(["id"=>$id])->column("path");
    }
    
    
}
