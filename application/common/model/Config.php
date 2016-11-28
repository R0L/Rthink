<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-14 11:21:25
 * @version V1.0
 * @desc   
 */
class Config extends BaseCommon {
    
    const CONFIG_SYSTEM = 0; //系统配置
    const CONFIG_WEBSITE = 1; //网站配置
    const CONFIG_PAYMENT = 2; //支付配置
    const CONFIG_MESSAGE = 3; //短信配置
    const CONFIG_MAIL = 4; //邮件配置


    public static $configTypeStstus=[0=>'系统配置',1 => '网站配置', 2 => '支付配置', 3 => '短信配置', 4 => '邮件配置'];

    
    //初始化
    protected function initialize() {
        parent::initialize();
    }

    /**
     * 获取配置的状态
     * @param type $configType
     * @param type $data
     * @return string
     */
    public static function getConfigTypeTextAttr($configType, $data) {
        if (empty($configType)) {
            $configType = $data["config_type"];
        }
        return self::$configTypeStstus[intval($configType)];
    }
    
    
    /**
     * 获得config的type
     * @return type
     */
    public static function getConfigType() {
        return ConfigModel::$configTypeStstus;
    }
    
    /**
     * 用于导出数据获取数据
     * @param type $ids
     * @return type
     */
    public static function selectToConfig($ids) {
        $data = [];
        $data[] = ["编号", "配置名称", "配置标题", "配置分组", "创建时间", "更新时间"];
        $configs = parent::all($ids);
        foreach ($configs as $config) {
            $data[] = [$config->id, $config->name, $config->title, $config->config_type_text, $config->create_time_fromat, $config->update_time_fromat];
        }
        return $data;
    }
    
    
    /**
     * 多数据 更新Config
     * @param type $id,$value
     * @param type $config_type
     * @return type
     */
    public static function updateByConfigType($id = [],$value = []) {
        for($i = 0;$i <count($id); $i++){
            parent::update(["value"=>$value[$i]], ["id"=>$id[$i]]);
        }
        return true;
    }
    
    /**
     * 查询Config 根据ConfigType状态
     * @param type $configType
     */
    public static function selectByConfigType($configType = 0) {
        return parent::all(["config_type" => $configType]);
    }
}
