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
     * 获得config的type
     * @return type
     */
    public static function getConfigType() {
        return ConfigModel::$configTypeStstus;
    }

    /**
     * 获得config的配置
     */
    public static function getConfig() {
        return ConfigModel::where(true)->field('type,name,value')->select();
    }

    /**
     * 用于导出数据获取数据
     * @param type $ids
     * @return type
     */
    public static function selectToConfig($ids) {
        $data = [];
        $data[] = ["编号", "配置名称", "配置标题", "配置分组", "创建时间", "更新时间"];
        $configs = ConfigModel::all($ids);
        foreach ($configs as $config) {
            $data[] = [$config->id, $config->name, $config->title, $config->config_type_text, $config->create_time_fromat, $config->update_time_fromat];
        }
        return $data;
    }

    /**
     * 查询Config 根据ConfigType状态
     * @param type $configType
     */
    public static function selectByConfigType($configType = 0) {
        return ConfigModel::all(["config_type" => $configType]);
    }
    
    
    /**
     * 查询支持的支付方式
     */
    public static function selectToPayType() {
        return ConfigModel::all(["config_type" => ConfigModel::CONFIG_PAYMENT,"name"=>["like","%_ON"],"value"=>1]);
    }

    /**
     * 多数据 更新Config
     * @param type $id,$value
     * @param type $config_type
     * @return type
     */
    public static function updateByConfigType($id = [],$value = []) {
        for($i = 0;$i <count($id); $i++){
            ConfigModel::update(["value"=>$value[$i]], ["id"=>$id[$i]]);
        }
        return true;
    }

}
