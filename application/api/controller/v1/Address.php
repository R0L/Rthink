<?php

namespace application\api\controller\v1;

use application\api\controller\Api;
use application\common\service\Address as AddressService;

/**
 * @author ROL
 * @date 2016-11-29 16:10:41
 * @version V1.0
 * @desc   
 */
class Address extends Api {

    /**
     * 个人地址展示接口
     * @param type $userId
     * @return type
     */
    public function index($userId) {
        $listAddress = AddressService::listAddress($userId);
        return parent::jCode(0, 1400, $listAddress->toArray());
    }

    /**
     * 个人地址添加接口
     * @param type $userId
     * @param type $recipients
     * @param type $phone
     * @param type $chooseArea
     * @param type $address
     * @param type $default
     * @return type
     */
    public function add($userId, $recipients, $phone, $chooseArea, $address = null, $default = 0) {
        $addAddress = AddressService::addAddress($userId, $recipients, $phone, $chooseArea, $address, $default);
        if ($addAddress->getError()) {
            return parent::jCode(1402, $addAddress->getError());
        }
        return parent::jCode(1401);
    }

    /**
     * 个人地址编辑接口
     * @param type $addresId
     * @param type $recipients
     * @param type $phone
     * @param type $chooseArea
     * @param type $address
     * @param type $default
     * @return type
     */
    public function edit($addresId, $recipients, $phone, $chooseArea, $address = null, $default = 0) {
        $editAddress = AddressService::editAddress($addresId, $recipients, $phone, $chooseArea, $address, $default);
        if ($editAddress->getError()) {
            return parent::jCode(1404, $editAddress->getError());
        }
        return parent::jCode(1403);
    }

    /**
     * 个人地址删除接口
     * @param type $addresId
     */
    public function delete($addresId) {
        $delAddress = AddressService::delAddress($addresId);
        if ($delAddress->getError()) {
            return parent::jCode(1406, $delAddress->getError());
        }
        return parent::jCode(1405);
    }

}
