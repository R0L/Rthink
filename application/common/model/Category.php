<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-8 14:58:12
 * @version V1.0
 * @desc   
 */
class Category extends BaseCommon {
    
    /**
     * 查询所有终极的栏目
     * @return type
     */
    public static function getLastLevelCategory() {
        return parent::all(["id"=>["not in",parent::column('pid')]]);
    }
}
