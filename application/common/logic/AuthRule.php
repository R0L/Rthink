<?php

namespace application\common\logic;

use application\common\model\AuthRule as AuthRuleModel;
use application\common\api\Cache;

/**
 * @author ROL
 * @date 2016-11-16 16:20:48
 * @version V1.0
 * @desc   
 */
class AuthRule extends AuthRuleModel {

    /**
     * 返回所有的AuthRule
     * @return type
     */
    public static function selectToAuthRule($map = []) {
        return AuthRuleModel::all($map);
    }

    /**
     * 根据id/name获得AuthRule
     * @param type $id
     * @param type $isName
     * @return type
     */
    public static function getAuthRule($id = NULL, $isName = false) {
        $map = [];
        if ($isName) {
            $map["name"] = $isName;
        } else if (is_numeric($id)) {
            $map["id"] = $id;
        } else if (is_string($id)) {
            $map["name"] = $id;
        }
        return AuthRuleModel::get($map);
    }

    
    /**
     * 删除缓存并添加访问规则
     * @param type $data
     * @return type
     */
    public function addAuthRule($data) {
        Cache::delCache();
        return AuthRuleModel::create($data);
    }
    
    /**
     * 删除缓存并编辑访问规则
     * @param type $data
     * @return type
     */
    public static function editAuthRule($data) {
        Cache::delCache();
        return AuthRuleModel::update($data,["id"=>$data["id"]]);
    }
    
    /**
     * 删除缓存并删除访问规则
     * @param type $ids
     * @param type $force
     */
    public static function delByIdsCache($ids, $force = false) {
        Cache::delCache();
        return parent::delByIds($ids, $force);
    }
    
}
