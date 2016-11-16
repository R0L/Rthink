<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-14 11:21:25
 * @version V1.0
 * @desc   
 */
class Config extends Base {
    
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
    
    
    
    
}
