<?php

namespace application\common\logic;
use application\common\model\Category as CategoryModel;
use application\common\model\Tree;
/**
 * @author ROL
 * @date 2016-11-19 9:17:48
 * @version V1.0
 * @desc   
 */
class Category extends CategoryModel{
    
    /**
     * 查询所有的Category
     * @return type
     */
    public static function selectToCategory() {
        return CategoryModel::useGlobalScope(false)->all();
    }
    
    /**
     * 返回所有的Categorytree
     * @return type
     */
    public static function selectToCategoryTree() {
        $Tree = new Tree();
        return $Tree->toTree(self::selectToCategory());
    }
    
    
}
