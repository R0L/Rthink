<?php

namespace application\common\logic;
use application\common\model\Action as ActionModel;
/**
 * @author ROL
 * @date 2016-11-23 12:38:37
 * @version V1.0
 * @desc   
 */
class Action extends ActionModel {
    
    
    /**
     * 获得Action 通过$name
     * @param type $name
     * @return type
     */
    public static function findActionByName($name) {
        return ActionModel::get(["name"=>$name]);
    }
    
    
}
