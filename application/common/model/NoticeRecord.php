<?php
namespace application\common\model;
/**
 * @author ROL
 * @date 2016-11-10 15:54:29
 * @version V1.0
 * @desc   
 */
class NoticeRecord extends Base {
    
    /**
     * 获取公告记录状态的格式化
     * @param type $notice_record_status
     * @param type $data
     * @return string
     */
    public function getNoticeRecordStatusTextAttr($notice_record_status, $data) {
        if (empty($notice_record_status)) {
            $notice_record_status = $data["notice_record_status"];
        }
        $op_status = [1 => '已阅读', 2 => '已点赞', 4 => '已回复', 8 => '再次回复'];
        return $op_status[intval($notice_record_status)];
    }
    
    
    /**
     * 公告记录中的公告阅读人
     * @return type
     */
    public function user() {
        return $this->belongsTo('application\common\model\User', "user_id", "id");
    }
    
    /**
     * 公告记录中的公告
     * @return type
     */
    public function notice() {
        return $this->belongsTo('application\common\model\Notice', "notice_id", "id");
    }
}
