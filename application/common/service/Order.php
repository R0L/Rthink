<?php
namespace application\common\service;
use application\common\logic\Order as OrderLogic;
/**
 * @author ROL
 * @date 2016-11-10 12:44:15
 * @version V1.0
 * @desc   
 */

class Order{
    
    
    /**
     * 进行中
     * @param type $userId
     * @return type
     */
    public function haveinhand($userId) {
        return OrderLogic::selectByOrderStatus($userId,OrderLogic::ORDER_HAVEINHAND);
    }
    
    /**
     * 已揭晓
     * @param type $userId
     * @return type
     */
    public function haslottery($userId) {
        return OrderLogic::selectByOrderStatus($userId,OrderLogic::HASWONTHEPRIZE|OrderLogic::ORDER_NOTWINNING);
    }
    
    /**
     * 已中奖
     * @param type $userId
     * @return type
     */
    public function haswontheprize($userId) {
        return OrderLogic::selectByOrderStatus($userId,OrderLogic::HASWONTHEPRIZE);
    }
    
    /**
     * 购物车
     * @param type $userId
     * @return type
     */
    public function shoppingcart($userId) {
        return OrderLogic::selectByOrderStatus($userId,OrderLogic::ORDER_SHOPPINGCART);
    }
    
    /**
     * 删除购物车
     * @param type $id
     * @return type
     */
    public function delShoppingcart($id) {
        return OrderLogic::delById($id);
    }
    
    /**
     * 添加购物车
     * @param type $data
     * @return type
     */
    public function addShoppingcart($data) {
        return OrderLogic::create($data);
    }
    
    /**
     * 编辑购物车
     * @param type $id
     * @param type $data
     * @return type
     */
    public function editShoppingcart($id,$data) {
        return OrderLogic::update($data,["id"=>$id]);
    }
    
}
