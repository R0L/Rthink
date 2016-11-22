<?php

namespace application\common\logic;

use application\common\model\Member as MemberModel;

/**
 * @author ROL
 * @date 2016-11-11 11:39:26
 * @version V1.0
 * @desc   
 */
class Member extends MemberModel {

    /**
     * 通过$userName获取用户
     * @param type $UserName
     * @return type
     */
    public static function getMemberByUserName($userName) {
        return MemberModel::get(["user_name" => $userName]);
    }

    /**
     * 通过$id获取用户
     * @param type $id
     * @return type
     */
    public static function getMemberById($id) {
        return MemberModel::get($id);
    }

}
