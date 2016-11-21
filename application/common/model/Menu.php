<?php

namespace application\common\model;
use application\common\model\Tree;

/**
 * @author ROL
 * @date 2016-11-5 11:24:23
 * @version V1.0
 * @desc   
 */
class Menu extends Base{
    
    public function menu(){
        return $this->hasOne('Menu',"id","pid");
    }
    
    public function getMenu() {
        $Tree = new Tree();
        return $Tree->toTree(self::all(["hide"=>0]));
    }
    
}
