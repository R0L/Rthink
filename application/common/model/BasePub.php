<?php

namespace application\common\model;

use think\Session;

/**
 * @author ROL
 * @date 2016-10-29 10:21:11
 * @version V1.0
 * @desc   
 */
class BasePub extends Base {

    protected $user_id = 0;
    protected $pub_id = 0;

    //初始化
    protected function initialize() {
        parent::initialize();
        $this->user_id = Session::get("user_id");
        if (!in_array($this->user_id, [1])) {
            $this->pub_id = $this->user_id;
        }
    }

    //自动完成
    protected $insert = [ 'create_time', 'pub_id'];

    /**
     * 所属平台自动完成
     * @param type $pub_id
     * @param type $data
     * @return type
     */
    protected function setPubIdAttr($pub_id, $data) {
        if (empty($pub_id)) {
            $pub_id = $this->pub_id;
        }
        return $pub_id;
    }

    // 定义全局的查询范围
    protected function base($query) {
        $map = [];
        empty($this->pub_id) || $map['pub_id'] = $this->pub_id;
        $query->where($map);
    }

}
