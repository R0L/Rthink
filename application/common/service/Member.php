<?php

namespace application\common\service;
use application\common\logic\Member;
/**
 * @author ROL
 * @date 2016-11-11 11:43:07
 * @version V1.0
 * @desc   
 */
class Member{
    
    
    public function getMemberByUserName($UserName) {
        $MemberLogic = new MemberLogic();
        return $MemberLogic->getMemberByUserName($UserName);
    }
    
    
}
