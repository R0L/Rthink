<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-10 15:41:09
 * @version V1.0
 * @desc   
 */
class Notice  extends Base{
    
    const NOTICE_NOTIFICATION = 0; //通知
    const NOTICE_ANNOUNCEMENT = 1; //公告


    public static $noticeTypeStstus=[0=>'通知',1 => '公告'];

    
    /**
     * 公告中的发布人
     * @return type
     */
    public function member() {
        return $this->belongsTo('application\common\model\Member', "member_id", "id");
    }
}
