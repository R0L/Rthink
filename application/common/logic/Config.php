<?php

namespace application\common\logic;

use application\common\model\Config as ConfigModel;

/**
 * @author ROL
 * @date 2016-11-14 11:40:39
 * @version V1.0
 * @desc   
 */
class Config extends ConfigModel{

    //初始化
    protected function initialize() {
        parent::initialize();
    }

    /**
     * 获得config的配置
     */
    public static function getConfig() {
        return ConfigModel::where(true)->field('type,name,value')->select();
    }


    
    /**
     * 查询支持的支付方式
     */
    public static function selectToPayType() {
        return ConfigModel::all(["config_type" => ConfigModel::CONFIG_PAYMENT,"name"=>["like","%_ON"],"value"=>1]);
    }


}
