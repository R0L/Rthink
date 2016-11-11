<?php

namespace application\admin\service;
use application\admin\logic\Member as MemberLogic;
/**
 * @author ROL
 * @date 2016-11-11 11:43:07
 * @version V1.0
 * @desc   
 */
class Member extends MemberLogic {
    
    
    public function getMemberByUserName($UserName) {
        $MemberLogic = new MemberLogic();
        return $MemberLogic->getMemberByUserName($UserName);
    }
    
    
}
