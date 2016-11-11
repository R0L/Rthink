<?php

namespace application\admin\logic;
use application\admin\model\Member as MemberModel;
/**
 * @author ROL
 * @date 2016-11-11 11:39:26
 * @version V1.0
 * @desc   
 */
class Member extends MemberModel {
    
    /**
     * 通过UserName获取用户
     * @param type $UserName
     * @return type
     */
    public function getMemberByUserName($UserName) {
       return MemberModel::get(["user_name"=>$UserName]);
    }
    
}
