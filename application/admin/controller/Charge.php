<?php

namespace application\admin\controller;
use application\common\model\Charge as ChargeModel;
use think\Request;
/**
 * @author ROL
 * @date 2016-11-10 16:23:31
 * @version V1.0
 * @desc   
 */
class Charge extends Admin {
    
    /**
     * 充值记录管理
     * @return type
     */
    public function index(Request $request,$map=[]) {
        if($title = $request->param("title")){
            $map["charge_code"] = ["like", "%" . $title . "%"];
        }
        $lists = ChargeModel::paginate($map);
        $this->assign("lists", $lists);
        return $this->fetch("index");
    }
    
    /**
     * 充值管理
     * @return type
     */
    public function recharge(Request $request) {
        return $this->index($request, ["money"=>["egt",0]]);
    }
    
    /**
     * 消费管理
     * @return type
     */
    public function consumption(Request $request) {
        return $this->index($request, ["money"=>["lt",0]]);
    }
}
