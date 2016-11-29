<?php

namespace application\common\service;
use application\common\logic\UserAddress;
use application\common\logic\Amap;

/**
 * @author ROL
 * @date 2016-11-29 16:23:49
 * @version V1.0
 * @desc   
 */
class Address extends Common {

    /**
     * 地址接口
     * @param type $adcode
     * @param type $level
     * @return type
     */
    public function listAmap($adcode = null, $level = "province") {
        return Amap::getAmap($adcode, $level);
    }

    /**
     * 添加地址
     * @return type
     */
    public static function addAddress($userId,$recipients,$phone,$chooseArea,$address=null,$default = 0) {
        parent::checkUserId($userId);
        $data["user_id"] = $userId;
        $data["recipients"] = $recipients;
        $data["phone"] = $phone;
        $data["chooseArea"] = $chooseArea;
        $data["address"] = $address;
        $data["default"] = $default;
        return UserAddress::create($data);
    }

    /**
     * 编辑地址
     * @return type
     */
    public static function editAddress($addresId,$recipients,$phone,$chooseArea,$address,$default) {
        $data["recipients"] = $recipients;
        $data["phone"] = $phone;
        $data["chooseArea"] = $chooseArea;
        $data["address"] = $address;
        $data["default"] = $default;
        return UserAddress::update($data, ["id"=>$addresId]);
    }

    /**
     * 删除地址
     * @param type $id
     * @return type
     */
    public static function delAddress($id) {
        return UserAddress::delById($id);
    }

    /**
     * 地址列表
     * @param type $userId
     * @return type
     */
    public static function listAddress($userId) {
        $address = UserAddress::selectAddressByUserId($userId);
        foreach ($address as $item) {
            $amapName = Amap::getAmapName($item["amap_id"]);
            $item->data("chooseArea",$amapName);
            $item->visible(["chooseArea","address","recipients","phone","default"]);
        }
        return $address;
    }

}
