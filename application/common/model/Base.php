<?php

namespace application\common\model;

use think\model;

/**
 * @author ROL
 * @date 2016-10-29 10:21:11
 * @version V1.0
 * @desc   
 */
class Base extends model {
    
    //自动完成
    protected $auto = [];
    protected $insert = [];  
    protected $update = []; 

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

    /**
     * 添加
     * @param type $data 添加数据
     * @return boolean 成功的时候返回添加的ID
     */
    public function add($data) {
        if ($this->allowField(true)->data($data)->save()) {
            return $this->id;
        } else {
            return false;
        }
    }

    /**
     * 多数据处理：添加或者更新
     * @param type $list 数据
     * @param type $status 默认 true 表示 有主键值时是更新，没有时田间；false 只会添加
     * @return boolean
     */
    public function saveAll($list, $status = true) {
        return $this->saveAll($list, $status);
    }

    /**
     * 删除
     * @param type $map 删除条件
     * @return boolean
     */
    public function delete($map) {
        return self::destroy($map);
    }

    /**
     * 更新
     * @param type $data 更新数据，含有主键的时候，可以不添加更新条件
     * @param type $map 更新条件
     * @return boolean
     */
    public function update($data, $map = true) {
        return self::where($map)->update($data);
    }

    /**
     * 获取单条数据
     * @param type $map 查询条件
     * @return 单条数据
     */
    public function find($map) {
        if(is_array($map))
        return self::get($map);
    }

    /**
     * 获取多条数据
     * @param type $map 查询条件
     * @return 多条数据
     */
    public function select($map) {
        return self::all($map);
    }

}
