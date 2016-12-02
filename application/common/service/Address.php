<?php

namespace application\common\service;
use application\common\logic\UserAddress;
use application\common\logic\Amap;
use application\common\api\Result;

/**
 * @author ROL
 * @date 2016-11-29 16:23:49
 * @version V1.0
 * @desc   
 */
class Address extends Common {

    /**
     * 地址接口
     * @return type
     */
    public static function listAmap($adcode,$level) {
        $amapList = Amap::getNextAmapList($adcode, $level);
        
        foreach ($amapList as $item) {
            if($level == "district"){
                $item->adcode = $item->areacode;
            }
            $item->visible(["adcode","name"]);
        }
        return Result::success(1407,$amapList);
    }

    /**
     * 添加地址
     * @return type
     */
    public static function addAddress($userId,$recipients,$phone,$chooseArea,$address=null,$default = 0) {
        $data["user_id"] = $userId;
        $data["recipients"] = $recipients;
        $data["phone"] = $phone;
        $data["amap_id"] = $chooseArea;
        $data["address"] = $address;
        $data["default"] = $default;
        $createModel = UserAddress::create($data);
        if ($createModel->getError()) {
            return Result::error(1402, $createModel->getError());
        }
        return Result::success(1401);
    }

    /**
     * 编辑地址
     * @return type
     */
    public static function editAddress($addresId,$recipients,$phone,$chooseArea,$address,$default) {
        $data["recipients"] = $recipients;
        $data["phone"] = $phone;
        $data["amap_id"] = $chooseArea;
        $data["address"] = $address;
        $data["default"] = $default;
        $updateModel = UserAddress::update($data, ["id"=>$addresId]);
        if ($updateModel->getError()) {
            return Result::error(1404, $updateModel->getError());
        }
        return Result::success(1403);
    }

    /**
     * 删除地址
     * @param type $id
     * @return type
     */
    public static function delAddress($id) {
        $delById = UserAddress::delById($id,true);
        if (empty($delById)) {
            return Result::error(1406);
        }
        return Result::success(1405);
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
        return Result::success(1400,$address);
    }

}
