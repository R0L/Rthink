<?php
namespace application\admin\model;
/**
 * @author ROL
 * @date 2016-11-18 16:03:30
 * @version V1.0
 * @desc   
 */
class Link extends Base {
    
    /**
     * 文章中的发布人
     * @return type
     */
    public function member() {
        return $this->belongsTo('application\admin\model\Member', "member_id", "id");
    }
}
