<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-8 14:58:12
 * @version V1.0
 * @desc   
 */
class Category extends Base {

    
    /**
     * 数据添加和数据更新的处理
     * @param type $data
     * @param type $where
     * @return type
     */
    public function deal($data = null,$where = null) {
        $status_create = $this->isUpdate(array_key_exists("id", $data))->allowField(true)->validate(true)->save($data,$where);
        if ($status_create) {
            return $this->id;
        }
        return $status_create;
    }
    
    /**
     * 查询所有终极的栏目
     * @return type
     */
    public function getLastLevelCategory() {
        return $this->all(["id"=>["not in",$this->column('pid')]]);
    }
    

}
