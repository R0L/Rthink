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
    protected $format = 'Y-m-d H:i';

    //初始化
    protected function initialize() {
        parent::initialize();
    }
    
    //自动完成
    protected $auto = ['update_time'];
    protected $insert = ['status' => 1,'create_time'];  
    protected $update = [];  
    
    /**
     * 创建时间自动完成
     * @return type
     */
    protected function setCreateTimeAttr(){
        return time();
    }
    
    /**
     * 更新时间自动完成
     * @return type
     */
    protected function setUpdateTimeAttr(){
        return time();
    }
    
    /**
     * 信息的状态
     * @param type $status
     * @param type $data
     * @return string
     */
    public function getStatusTextAttr($status, $data) {
        if (empty($status)) {
            $status = $data["status"];
        }
        $op_status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $op_status[intval($status)];
    }

    /**
     * 获取创建时间格式化
     * @param type $create_time
     * @return type
     */
    public function getCreateTimeFromatAttr($create_time, $data) {
        if (empty($create_time)) {
            $create_time = $data["create_time"];
        }
        $time = $create_time === NULL ? time() : intval($create_time);
        return date($this->format, $time);
    }

    /**
     * 获取更新时间格式化
     * @param type $update_time
     * @return type
     */
    public function getUpdateTimeFromatAttr($update_time, $data) {
        if (empty($update_time)) {
            $create_time = $data["update_time"];
        }
        $time = $update_time === NULL ? time() : intval($update_time);
        return date($this->format, $time);
    }
    /**
     * 获取是否显示的格式化
     * @param type $display
     * @param type $data
     * @return string
     */
    public function getDisplayTextAttr($display, $data) {
        if (empty($display)) {
            $display = $data["display"];
        }
        $op_status = [0 => '否', 1 => '是'];
        return $op_status[intval($display)];
    }
    
    /**
     * 获取终端类型的格式化
     * @param type $terminal
     * @param type $data
     * @return string
     */
    public function getTerminalTextAttr($terminal, $data) {
        if (empty($terminal)) {
            $terminal = $data["terminal"];
        }
        $op_status = [1 => 'PC', 2 => 'WAP', 3 => "Android", 4 => "IOS", 5 => "WeChat"];
        return $op_status[intval($terminal)];
    }

    //类型转换
    protected $type = [];

    /**
     * 数据添加和数据更新的处理
     * @param type $data
     * @param type $where
     * @return type
     */
    public function deal($data = null, $where = null) {
        $status_create = $this->isUpdate(array_key_exists("id", $data))->allowField(true)->validate(true)->save($data, $where);
        if ($status_create) {
            return $this->id;
        }
        return $status_create;
    }
}
