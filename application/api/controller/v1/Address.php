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
        $result = AddressService::listAddress($userId);
        return parent::jResult($result);
    }
    
    /**
     * 获取数据库地址列表接口
     * @param type $adcode
     * @param type $level
     * @return type
     */
    public function amap($adcode=null,$level="province") {
        $result = AddressService::listAmap($adcode,$level);
        return parent::jResult($result);
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
        $result = AddressService::addAddress($userId, $recipients, $phone, $chooseArea, $address, $default);
        return parent::jResult($result);
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
        $result = AddressService::editAddress($addresId, $recipients, $phone, $chooseArea, $address, $default);
        return parent::jResult($result);
    }

    /**
     * 个人地址删除接口
     * @param type $addresId
     */
    public function del($addresId) {
        $result = AddressService::delAddress($addresId);
        return parent::jResult($result);
    }

}
