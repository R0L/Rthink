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
        return parent::jCode(0, 1700, $listShare->toArray());
    }

    /**
     * 晒单添加接口
     * @param type $title
     * @param type $content
     * @param type $pictures
     * @return type
     */
    public function add($title, $content, $pictures) {
        $addShare = ShareService::addShare($title, $content, $pictures);
        if ($addShare->getError()) {
            return parent::jCode(1702, $addShare->getError());
        }
        return parent::jCode(0, 1701);
    }

    /**
     * 晒单编辑接口
     * @param type $id
     * @param type $title
     * @param type $content
     * @param type $pictures
     * @return type
     */
    public function edit($id, $title, $content, $pictures) {
        $editShare = ShareService::editShare($id, $title, $content, $pictures);
        if ($editShare->getError()) {
            return parent::jCode(1704, $editShare->getError());
        }
        return parent::jCode(0, 1703);
    }

    /**
     * 晒单删除接口
     * @param type $id
     * @return type
     */
    public function delete($id) {
        $delShare = ShareService::delShare($id);
        if (empty($delShare)) {
            return parent::jCode(1704);
        }
        return parent::jCode(0, 1705);
    }

}
