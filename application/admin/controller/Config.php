<?php

namespace application\admin\controller;
use application\admin\logic\Config as ConfigLogic;
use think\Request;
/**
 * @author ROL
 * @date 2016-11-14 11:14:57
 * @version V1.0
 * @desc   
 */
class Config extends Admin {
    
    /**
     * 网站配置
     * @param Request $request
     * @return type
     */
    public function website(Request $request) {
        $lists = ConfigLogic::paginate($request->param());
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    /**
     * 删除配置
     * @param Request $request
     */
    public function del(Request $request) {
        $id = $request->param("id");
        empty($id) && $this->error("参数ID为空");
        $statusDel = ConfigLogic::del(["id"=>$id]);
        if($statusDel){
            $this->success("操作成功");
        }
        $this->error("操作失败");
    }
    
    /**
     * 编辑或者添加配置
     * @param Request $request
     */
    public function deal(Request $request) {
        if($request->isPost()){
            $deal = ConfigLogic::deal($request->param());
            if($deal){
                $this->success("操作成功","website");
            }
            $this->error("操作失败");
        }
        $id = $request->param("id");
        if($id){
            $config_get = ConfigLogic::getLineData(["id"=>$id]);
            $this->assign("info", $config_get);
        }
        $configType = ConfigLogic::getConfigType();
        $this->assign("config_type_list", $configType);
        return $this->fetch("edit");
    }
    
    
    
    /**
     * 支付配置
     * @param Request $request
     * @return type
     */
    public function payment(Request $request) {
        return $this->fetch();
    }
    /**
     * 短信配置
     * @param Request $request
     * @return type
     */
    public function message(Request $request) {
        return $this->fetch();
    }
    /**
     * 邮件配置
     * @param Request $request
     * @return type
     */
    public function mail(Request $request) {
        return $this->fetch();
    }
    
}
