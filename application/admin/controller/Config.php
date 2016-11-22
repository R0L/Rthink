<?php

namespace application\admin\controller;
use application\common\logic\Config as ConfigLogic;
use think\Request;
/**
 * @author ROL
 * @date 2016-11-14 11:14:57
 * @version V1.0
 * @desc   
 */
class Config extends Admin {
    
    /**
     * 配置列表
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $param = $request->except("page");
        $lists = ConfigLogic::paginate($param);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    
    /**
     * 网站配置
     * @param Request $request
     * @return type
     */
    public function website(Request $request) {
        return $this->setConfig($request, ConfigLogic::CONFIG_WEBSITE);
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
                $this->success("操作成功","index");
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
     * 导出
     * @param Request $request
     */
    public function export(Request $request) {
        $selectToConfig = ConfigLogic::selectToConfig($request->param("ids/a"));
        create_xls($selectToConfig,"网站配置列表".date("Y-m-d H:i:s").".xls");
    }
    
    /**
     * 导入
     * @param Request $request
     */
    public function import(Request $request){
        return;
    }
    
    /**
     * 设置界面的共有方法
     * @param Request $request
     * @param type $ConfigType
     */
    private function setConfig(Request $request,$ConfigType=0){
        if($request->isPost()){
            $statusUpdate = ConfigLogic::updateByConfigType($request->param("id/a"),$request->param("value/a"));
            if($statusUpdate){
                $this->success("操作成功");
            }
            $this->error("操作失败");
        }
        $selectByConfigType = ConfigLogic::selectByConfigType($ConfigType);
        $this->assign("info_list",$selectByConfigType);
        return $this->fetch("config");
    }


    /**
     * 支付配置
     * @param Request $request
     * @return type
     */
    public function payment(Request $request) {
        return $this->setConfig($request, ConfigLogic::CONFIG_PAYMENT);
    }
    /**
     * 短信配置
     * @param Request $request
     * @return type
     */
    public function message(Request $request) {
        return $this->setConfig($request, ConfigLogic::CONFIG_MESSAGE);
    }
    /**
     * 邮件配置
     * @param Request $request
     * @return type
     */
    public function mail(Request $request) {
        return $this->setConfig($request, ConfigLogic::CONFIG_MAIL);
    }
    
}
