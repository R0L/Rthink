<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-8 13:36:16
 * @version V1.0
 * @desc   
 */
class User extends BasePub {
    
    // 定义时间戳字段名
    protected $createTime = 'register_time';
    protected $updateTime = 'last_login_time';

    //自动完成
    protected $auto = ['last_login_time', 'last_login_ip'];
    protected $insert = ['status' => 1,'login_num'=> 0,'register_time', 'register_ip','pub_id'];
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
     * 数据添加
     * @param type $data
     * @return type
     */
    public static function create($data = []){
        $model = new static();
        $model->validate(true)->isUpdate(false)->allowField(true)->profile()->save($data, []);
        return $model;
    }
    
}
