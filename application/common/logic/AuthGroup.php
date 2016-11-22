<?php

namespace application\common\logic;
use application\common\model\AuthGroup as AuthGroupModel;

/**
 * @author ROL
 * @date 2016-11-12 9:45:54
 * @version V1.0
 * @desc   
 */
class AuthGroup extends AuthGroupModel {

    /**
     * 更新权限组表
     * @param type $id
     * @param type $rules
     * @return type
     */
    public function updateAuthGroup($id, $rules) {
        return AuthGroupModel::update(["rules" => $rules], ["id" => $id]);
    }

    /**
     * 查询AuthGroup数据
     * @param type $id
     * @return type
     */
    public static function selectToGroup($id = null) {
        $map = [];
        $id && $map["id"] = $id;
        return AuthGroupModel::all($map);
    }

    /**
     * 添加user到GROUP
     * @param type $data
     * @return type
     */
    public static function addToGroup($data) {
        return AuthGroup::create($data);
    }

    /**
     * 根据id返回auth_group的rules栏目
     * @param type $id
     * @return type
     */
    public static function getRulesToGroup($id) {
        return AuthGroup::get($id)->value("rules");
    }

}
