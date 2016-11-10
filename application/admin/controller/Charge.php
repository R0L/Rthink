<?php

namespace application\admin\controller;
use application\admin\model\Charge as ChargeModel;
/**
 * @author ROL
 * @date 2016-11-10 16:23:31
 * @version V1.0
 * @desc   
 */
class Charge extends Admin {
    
    /**
     * 账户管理
     * @return type
     */
    public function index() {
        $map = array();
        $map["status"] = 1;
        $charge_status = trim(input('charge_status'));
        if (!empty($charge_status)) {
            $map["charge_status"] = $charge_status;
        }
        $Charge = new ChargeModel();
        $lists = $Charge->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    /**
     * 充值管理
     * @return type
     */
    public function recharge() {
        $map = array();
        $map["status"] = 1;
        $map["money"]=["egt",0];
        $charge_status = trim(input('charge_status'));
        if (!empty($charge_status)) {
            $map["charge_status"] = $charge_status;
        }
        $Charge = new ChargeModel();
        $lists = $Charge->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch("index");
    }
    
    /**
     * 消费管理
     * @return type
     */
    public function consumption() {
        $map = array();
        $map["status"] = 1;
        $map["money"]=["lt",0];
        $charge_status = trim(input('charge_status'));
        if (!empty($charge_status)) {
            $map["charge_status"] = $charge_status;
        }
        $Charge = new ChargeModel();
        $lists = $Charge->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch("index");
    }
}
