<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-8 13:36:16
 * @version V1.0
 * @desc   
 */
class User extends Base {

    //自动完成
    protected $auto = ['last_login_time', 'last_login_ip'];
    protected $insert = ['status' => 1, 'register_time', 'register_ip'];
    protected $update = [];

    /**
     * 注册时间自动完成
     * @return type
     */
    protected function setRegisterTimeAttr() {
        return time();
    }

    /**
     * 最后登录时间自动完成
     * @return type
     */
    protected function setLastLoginTimeAttr() {
        return time();
    }

    /**
     * 注册IP自动完成
     * @return type
     */
    protected function setRegisterIpAttr() {
        return request()->ip();
    }

    /**
     * 最后登录IP自动完成
     * @return type
     */
    protected function setLastLoginIpAttr() {
        return request()->ip();
    }

    /**
     * 获取注册时间格式化
     * @param type $register_time
     * @param type $data
     * @return type
     */
    public function getRegisterTimeFromatAttr($register_time, $data) {
        if (empty($register_time)) {
            $register_time = $data["register_time"];
        }
        $time = $register_time === NULL ? time() : intval($register_time);
        return date($this->format, $time);
    }

    /**
     * 获取最后登录时间格式化
     * @param type $last_login_time
     * @param type $data
     * @return type
     */
    public function getLastLoginTimeFromatAttr($last_login_time, $data) {
        if (empty($last_login_time)) {
            $last_login_time = $data["last_login_time"];
        }
        $time = $last_login_time === NULL ? time() : intval($last_login_time);
        return date($this->format, $time);
    }

    /**
     * 用户相关信息
     * @return type
     */
    public function userinfo() {
        return $this->hasOne('UserInfo', "user_id", "id");
    }

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
