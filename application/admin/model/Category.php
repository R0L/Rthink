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
     * 查询所有终极的栏目
     * @return type
     */
    public function getLastLevelCategory() {
        return $this->all(["id"=>["not in",$this->column('pid')]]);
    }
    

}
