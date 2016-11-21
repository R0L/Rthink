<?php
namespace application\admin\controller;
use application\common\logic\Order as OrderLogic;
use think\Request;
/**
 * @author ROL
 * @date 2016-11-10 12:41:08
 * @version V1.0
 * @desc   
 */
class Order extends Admin {
    
    /**
     * 订单列表的操作
     * @param Request $request
     * @param type $order_status
     * @return type
     */
    public function index(Request $request,$order_status) {
        $map = [];
        if($title = $request->param("title")){
            $map["title"] = ["like", "%" . $title . "%"];
        }
        if(empty($order_status)){
            $order_status = $request->param("order_status");
        }
        $map["order_status"] = $order_status;
        $lists = OrderLogic::paginate($map);
        $this->assign('lists', $lists);
        $this->assign("order_status", $order_status);
        return $this->fetch("index");
    }
    
    /**
     * 订单 购物车
     * @param Request $request
     * @return type
     */
    public function shoppingcart(Request $request) {
        return $this->index($request, OrderLogic::ORDER_SHOPPINGCART);
    }
    
    /**
     * 订单 进行中
     * @param Request $request
     * @return type
     */
    public function haveinhand(Request $request) {
        return $this->index($request, OrderLogic::ORDER_HAVEINHAND);
    }
    
    /**
     * 订单 已中奖
     * @param Request $request
     * @return type
     */
    public function haswontheprize(Request $request) {
        return $this->index($request, OrderLogic::ORDER_HASWONTHEPRIZE);
    }
    
    /**
     * 订单 未中奖
     * @param Request $request
     * @return type
     */
    public function notwinning(Request $request) {
        return $this->index($request, OrderLogic::ORDER_NOTWINNING);
    }
    
    /**
     * 订单 已晒单
     * @param Request $request
     * @return type
     */
    public function sunsheet(Request $request) {
        return $this->index($request, OrderLogic::ORDER_SUNSHEET);
    }
    
}
