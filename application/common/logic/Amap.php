<?php

namespace application\common\logic;

use application\common\model\Amap as AmapModel;
/**
 * @author ROL
 * @date 2016-11-22 10:33:40
 * @version V1.0
 * @desc   
 */
class Amap extends AmapModel{
    
    
    /**
     * 获取地址 通过$adcode和$level
     * @param type $adcode
     * @param type $level
     * @return type
     */
    public static function getAmap($adcode=null,$level="province") {
        $map["level"] = $level;
        empty($adcode) || $map["adcode"] = $adcode;
        return AmapModel::all($map);
    }
    
    
}
