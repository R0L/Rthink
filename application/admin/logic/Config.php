<?php

namespace application\admin\logic;
use application\admin\model\Config as ConfigModel;

/**
 * @author ROL
 * @date 2016-11-14 11:40:39
 * @version V1.0
 * @desc   
 */
class Config extends ConfigModel {
    
    
    //初始化
    protected function initialize() {
        parent::initialize();
    }
    
    /**
     * 获得config的type
     * @return type
     */
    public static function getConfigType() {
        return parent::$configTypeStstus;
    }
    
    /**
     * 获得config的配置
     */
    public static function getConfig() {
        parent::where(true)->column("title","name");
    }
    
}
