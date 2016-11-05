<?php

namespace application\admin\model;
use think\Model;

/**
 * @author ROL
 * @date 2016-10-29 10:21:11
 * @version V1.0
 * @desc   
 */
class Base extends Model {

    //初始化
    protected function initialize() {
        parent::initialize();
    }

    //获取器
    public function getStatusAttr($value) {
        $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $status[$value];
    }

    //修改器
    public function setNameAttr($value, $data) {
        return serialize($data);
    }

    //类型转换
    protected $type = [];

}
