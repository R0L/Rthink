<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-10 15:41:09
 * @version V1.0
 * @desc   
 */
class Notice  extends Base{
    
    /**
     * 公告中的发布人
     * @return type
     */
    public function member() {
        return $this->belongsTo('application\admin\model\Member', "member_id", "id");
    }
}
