<?php

namespace application\admin\model;

use think\Model;

/**
 * @author ROL
 * @date 2016-11-8 13:36:16
 * @version V1.0
 * @desc   
 */
class User extends Base {

    /**
     * 获取用户
     * @param type $uid
     * @param type $is_username
     * @return type
     */
    public function info($uid, $is_username = false) {
        $map = array();
        if ($is_username) { //通过用户名获取
            $map['username'] = $uid;
        } else {
            $map['id'] = $uid;
        }

        $user = $this->where($map)->field('id,user_name,status')->find();
        if (is_object($user) && $user->status == 1) {
            return array($user->id, $user->user_name);
        } else {
            return -1; //用户不存在或被禁用
        }
    }

}
