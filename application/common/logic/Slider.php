<?php

namespace application\common\logic;
use application\common\model\Slider as SliderModel;
/**
 * @author ROL
 * @date 2016-11-24 16:21:15
 * @version V1.0
 * @desc   
 */
class Slider extends SliderModel{
    
    
    /**
     * 获取Slider 通过$map
     * @param type $map
     * @return type
     */
    public static function selectToSlider($map=[]) {
        return SliderModel::all($map);
    }
    
    
}
