<?php

namespace application\common\logic;
use application\common\model\NoticeRecord as NoticeRecordModel;

/**
 * @author ROL
 * @date 2016-12-1 15:53:27
 * @version V1.0
 * @desc   
 */
class NoticeRecord extends NoticeRecordModel{
    
    /**
     * 获得NoticeRecord 通过$userId,$noticeId
     * @param type $userId
     * @param type $noticeId
     */
    public static function getNoticeRecordByUserId($userId,$noticeId) {
        return NoticeRecord::get(["user_id"=>$userId,"notice_id"=>$noticeId]);
    }
    
    /**
     * 修改阅读状态
     * @param type $userId
     * @param type $noticeId
     * @param type $noticeRecordRtatus
     * @return type
     */
    public static function updateNoticeRecord($userId,$noticeId,$noticeRecordRtatus = NoticeRecordModel::ALREADY_READ) {
        return NoticeRecordModel::create(["notice_record_status"=>$noticeRecordRtatus,"user_id"=>$userId,"notice_id"=>$noticeId]);
    }
    
}
