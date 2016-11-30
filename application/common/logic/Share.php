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
     * 获取Share  通过 $shareStatus
     * @param $shareStatus
     * @return type
     */
    public static function selectByShareStatus($shareStatus=ShareModel::SHARE_SUCCESS) {
        return ShareModel::paginate(["share_status"=>$shareStatus]);
    }
    /**
     * 获取Share  通过 $userId
     * @param $userId
     * @return type
     */
    public static function selectByUserId($userId) {
        return ShareModel::paginate(["user_id"=>$userId]);
    }
    
}
