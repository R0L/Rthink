<?php

namespace application\common\service;
use application\common\logic\Member as MemberLogic;
/**
 * @author ROL
 * @date 2016-11-11 11:43:07
 * @version V1.0
 * @desc   
 */
class Member{
    
    
    public function getMemberByUserName($UserName) {
        return MemberLogic::getMemberByUserName($UserName);
    }
    
    
    public function getMemberById($id) {
        return MemberLogic::get($id);
    }
    
    
}
