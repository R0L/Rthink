<?php

namespace application\common\logic;
use application\common\model\Notice as NoticeModel;
/**
 * @author ROL
 * @date 2016-11-22 13:52:36
 * @version V1.0
 * @desc   
 */
class Notice extends NoticeModel {
    
    
    /**
     * 获得notice 通过$noticeType
     * @param type $userId
     * @param type $noticeType
     * @return type
     */
    public static function selectByNoticeType($userId,$noticeType=NoticeModel::NOTICE_NOTIFICATION) {
        return NoticeModel::all(["user_id"=>$userId,"notice_type"=>$noticeType]);
    }
    
    
}
