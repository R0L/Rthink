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
    public static function updateAuthGroup($id, $rules) {
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
     * 添加GROUP
     * @param type $data
     * @return type
     */
    public function addAuthGroup($data) {
        return $this->add($data);
    }
    
    /**
     * 编辑GROUP
     * @param type $data
     * @param type $id
     * @return type
     */
    public function editAuthGroup($data,$id) {
        return $this->edit($data,["id"=>$id]);
    }

    /**
     * 根据id返回auth_group的rules栏目
     * @param type $id
     * @return type
     */
    public static function getRulesToGroup($id) {
        return AuthGroup::where(["id"=>$id])->value("rules");
    }

}
