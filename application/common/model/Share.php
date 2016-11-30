<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-10 10:19:58
 * @version V1.0
 * @desc   
 */
class Share extends Base {
    
    
    
    public static $shareStatus = [-1 => '审核失败', 0 => '已提交', 1 => '审核成功'];

    const SHARE_INIT = 0;
    const SHARE_FAIL = -1;
    const SHARE_SUCCESS = 1;
    
    protected $insert = ['status' => 1, 'share_status' => 1, 'create_time'];

    /**
     * 获取晒单状态
     * @param type $share_status
     * @param type $data
     * @return string
     */
    public function getShareStatusTextAttr($share_status, $data) {
        if (empty($share_status)) {
            $share_status = $data["share_status"];
        }
        return self::$shareStatus[intval($share_status)];
    }

    /**
     * 晒单中的期数
     * @return type
     */
    public function period() {
        return $this->belongsTo("application\common\model\Period", "period_id", "id");
    }

    /**
     * 晒单中的用户
     * @return type
     */
    public function user() {
        return $this->belongsTo('application\common\model\User', "user_id", "id");
    }

}
