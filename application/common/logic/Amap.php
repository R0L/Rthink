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
        empty($level) || $map["level"] = $level;
        empty($adcode) || $map["adcode"] = $adcode;
        return AmapModel::where($map)->field(["adcode","name"])->paginate();
    }
    
    /**
     * 获取下级地址
     * @param type $adcode
     * @param type $level
     * @return type
     */
    public static function getNextAmapList($adcode=null,$level="province") {
        switch ($level){
            case "province":
                $map["adcode"] = ["like","__0000"];
                break;
            case "city":
                $map["adcode"] = ["like",substr($adcode, 0, 2)."__00"];
                break;
            case "district":
                $map["adcode"] = ["like",substr($adcode, 0, 4)."__00"];
                break;
        }
        $map["level"] = $level;
        return AmapModel::all($map);
    }
    
    
    /**
     * 1-2-3 转化为 四川省 成都市 仁寿县 等
     * @param type $amap_id
     * @return type
     */
     public static function getAmapName($amap_id=null) {
         $amapExplode = explode("-", $amap_id);
         $amap = "";
         foreach ($amapExplode as $item) {
             $amapName = AmapModel::where(["adcode"=>$item])->value("name");
             $amap .= $amapName;
         }
         return $amap;
    }
    
}
