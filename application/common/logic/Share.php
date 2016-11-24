<?php

namespace application\common\logic;
use application\common\model\Share as ShareModel;
/**
 * @author ROL
 * @date 2016-11-24 16:12:13
 * @version V1.0
 * @desc   
 */
class Share extends ShareModel{
    
    
    /**
     * 获取Share  分页
     * @return type
     */
    public static function selectToShare() {
        return ShareModel::paginate();
    }
    
}
