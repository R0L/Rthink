<?php

namespace application\api\controller\v1;

use application\api\controller\Api;
use application\common\service\Share as ShareService;

/**
 * @author ROL
 * @date 2016-11-30 10:41:27
 * @version V1.0
 * @desc   
 */
class Share extends Api {

    /**
     * 晒单列表接口 展示给所有的用户的
     * @return type
     */
    public function index() {
        $listShare = ShareService::listShare();
        return parent::jResult($listShare);
    }

    /**
     * 晒单添加接口
     * @param type $userId
     * @param type $periodId
     * @param type $title
     * @param type $content
     * @param type $pictures
     * @return type
     */
    public function add($userId,$periodId,$title, $content, $pictures) {
        $addShare = ShareService::addShare($userId,$periodId,$title, $content, $pictures);
        return parent::jResult($addShare);
    }

    /**
     * 晒单编辑接口
     * @param type $shareId
     * @param type $title
     * @param type $content
     * @param type $pictures
     * @return type
     */
    public function edit($shareId, $title, $content, $pictures) {
        $editShare = ShareService::editShare($shareId, $title, $content, $pictures);
        return parent::jResult($editShare);
    }

    /**
     * 晒单删除接口
     * @param type $shareId
     * @return type
     */
    public function del($shareId) {
        $delShare = ShareService::delShare($shareId);
        return parent::jResult($delShare);
    }

}
