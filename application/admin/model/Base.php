<?php

namespace application\admin\model;

use think\Model;
use think\Session;

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
        $op_status = [1=>'系统',2 => 'PC', 3 => 'WAP', 4 => "Android", 5 => "IOS", 6 => "WeChat"];
        return $op_status[intval($terminal)];
    }

    //类型转换
    protected $type = [
        'picture_id'      =>  'array',
    ];
    
    
    // 定义全局的查询范围
    protected function base($query) {
        $map['status'] = 1;
        $user_id = Session::get("user_id");
        if(!in_array($user_id,[1] ) ){
           $map['pub_id'] = $user_id;
        }
        $query->where($map);
    }

    /**
     * 数据添加和数据更新的处理
     * @param type $data
     * @param type $where
     * @return type
     */
//    public function deal($data = null, $where = null) {
//        $status_create = $this->isUpdate(array_key_exists("id", $data))->allowField(true)->validate(true)->save($data, $where);
//        if ($status_create) {
//            return $this->id;
//        }
//        return $status_create;
//    }
    
    
    
    /**
     * 分页
     */
    public static function paginate($map = null) {
        return parent::where($map)->paginate();
    }
    
    /**
     * 操作数据的更新或添加
     * @param type $data
     * @param type $map
     * @return type
     */
    public static function deal($data,$map = NULL) {
        if(array_key_exists("id", $data)){
            return self::update($data, $map);
        }
        $create = self::create($data); //20161118
        if(empty($create)){
            return false;
        }
        return $create->id;
    }
    
    /**
     * 根据id删除
     * @param type $map
     * @return type
     */
    public static function del($map = NULL) {
        return parent::update(["status"=>-1],$map);
    }
    /**
     * 根据ids删除
     * @param type $ids
     * @return type
     */
    public static function delByIds($ids = []) {
        return parent::update(["status"=>-1],["id"=>["in",$ids]]);
    }
    
    /**
     * 根据id查询
     * @param type $map
     * @return type
     */
    public static function getLineData($map=NULL) {
        return parent::get($map);
    }
    
    
    /**
     * 根据条件清空
     * @param type $map
     * @return type
     */
    public static function clear($map=NULL) {
        return parent::destroy($map);
    }
}
