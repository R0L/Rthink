<?php

namespace application\admin\model;

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
        dump(self::all()->toArray());
//        return model('Common/Tree')->toFormatTree();
    }
    
}
