<?php

namespace application\common\model;

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

    /**
     * 数据状态
     * @var type 
     */
    public static $STATUS = [-1 => '删除', 0 => '禁用', 1 => '正常'];
    public static $DISPLAY = [0 => '否', 1 => '是'];
    public static $TERMINAL = [1 => '系统', 2 => 'PC', 3 => 'WAP', 4 => "Android", 5 => "IOS", 6 => "WeChat"];

    const STATUS_DEL = -1; //删除
    const STATUS_DISABLE = 0; //禁用
    const STATUS_NORMAL = 1; //正常
    const DISPLAY_NO = 0; //否
    const DISPLAY_YES = 1; //是
    const TERMINAL_SYSTEM = 1; //系统
    const TERMINAL_PC = 2; //PC
    const TERMINAL_WAP = 3; //WAP
    const TERMINAL_ANDROID = 4; //Android
    const TERMINAL_IOS = 5; //IOS
    const TERMINAL_WECHAT = 6; //WeChat

    //初始化

    protected function initialize() {
        parent::initialize();
        $this->validate = true;
    }

    //自动完成
    protected $auto = ['update_time'];
    protected $insert = ['status' => self::STATUS_NORMAL, 'create_time'];
    protected $update = [];

    /**
     * 创建时间自动完成
     * @return type
     */
    protected function setCreateTimeAttr() {
        return time();
    }

    /**
     * 更新时间自动完成
     * @return type
     */
    protected function setUpdateTimeAttr() {
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
        return self::$STATUS[intval($status)];
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
            $update_time = $data["update_time"];
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
        return self::$DISPLAY[intval($display)];
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
        return self::$TERMINAL[intval($terminal)];
    }

    //类型转换
    protected $type = [
    ];

    // 定义全局的查询范围
    protected function base($query) {
        $map['status'] = self::STATUS_NORMAL;
        $query->where($map);
    }

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
    public static function deal($data, $map = NULL) {
        if (array_key_exists("id", $data)) {
            return self::update($data, $map);
        }
        $create = self::create($data); //20161118
        if (empty($create)) {
            return false;
        }
        return $create->id;
    }
    
    
    /**
     * 数据添加
     * @param type $data
     * @return type
     */
    public function add($data) {
        return $this->validate(true)->all($data);
    }
    
    /**
     * 数据编辑
     * @param type $data
     * @param type $where
     * @return type
     */
    public function edit($data,$where) {
        return $this->validate(true)->update($data, $where);
    }
    

    /**
     * 根据id删除
     * @param type $map
     * @return type
     */
    public static function del($map = NULL) {
        return parent::update(["status" => self::STATUS_DEL], $map);
    }

    /**
     * 根据ids删除
     * @param type $ids
     * @return type
     */
    public static function delByIds($ids = []) {
        return parent::update(["status" => self::STATUS_DEL], ["id" => ["in", $ids]]);
    }

    /**
     * 根据id查询
     * @param type $map
     * @return type
     */
    public static function getLineData($map = NULL) {
        return parent::get($map);
    }

    /**
     * 根据条件清空
     * @param type $map
     * @return type
     */
    public static function clear($map = NULL) {
        return parent::destroy($map);
    }

}
