<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-10 10:20:34
 * @version V1.0
 * @desc   
 */
class UserAddress extends Base {

    
    /**
     * 地址是否默认
     * @param type $default
     * @param type $data
     * @return string
     */
    public function getDefaultTextAttr($default, $data) {
        if (empty($default)) {
            $default = $data["default"];
        }
        $op_status = [1 => '默认', 0 => '可选'];
        return $op_status[intval($default)];
    }
    
    /**
     * 用户信息
     * @return type
     */
    public function user() {
        return $this->belongsTo('User', "user_id", "id");
    }

}
