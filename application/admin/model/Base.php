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
    
    protected $autoWriteTimestamp = true;

    private $format='Y-m-d H:i';
    
    //初始化
    protected function initialize() {
        parent::initialize();
    }

    /**
     * 信息的状态
     * @param type $status
     * @param type $data
     * @return string
     */
    public function getStatusTextAttr($status,$data) {
        if(empty($status)){
            $status = $data["status"];
        }
        $op_status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $op_status[intval($status)];
    }

    /**
     * 创建时间格式化
     * @param type $create_time
     * @return type
     */
    public function getCreateTimeFromatAttr($create_time,$data) {
        if(empty($create_time)){
            $create_time = $data["create_time"];
        }
        $time = $create_time === NULL ? time() : intval($create_time);
        return date($this->format, $time);
    }
    
    /**
     * 更新时间格式化
     * @param type $update_time
     * @return type
     */
    public function getUpdateTimeFromatAttr($update_time,$data) {
        if(empty($create_time)){
            $create_time = $data["update_time"];
        }
        $time = $update_time === NULL ? time() : intval($update_time);
        return date($this->format, $time);
    }

    //类型转换
    protected $type = [];

}
