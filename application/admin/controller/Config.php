<?php

namespace application\admin\controller;
use application\common\model\Config as ConfigModel;
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
        $lists = ConfigModel::paginate($param);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    
    /**
     * 网站配置
     * @param Request $request
     * @return type
     */
    public function website(Request $request) {
        return $this->setConfig($request, ConfigModel::CONFIG_WEBSITE);
    }
    
    /**
     * 删除配置
     * @param Request $request
     */
    public function del(Request $request) {
        $this->opReturn(ConfigModel::delByIds($request->param("id/a")));
    }
    
    /**
     * 配置添加
     * @param Request $request
     */
    public function add(Request $request) {
        if($request->isPost()){
            $this->opReturn(ConfigModel::create($request->param()));
        }
        $this->assign("config_type_list", ConfigModel::getConfigType());
        return $this->fetch("edit");
    }
    
    /**
     * 配置编辑
     * @param Request $request
     */
    public function edit(Request $request) {
        if($request->isPost()){
            $this->opReturn(ConfigModel::update($request->param()));
        }
        $this->assign("info", ConfigModel::get($request->param("id")));
        $this->assign("config_type_list", ConfigModel::getConfigType());
        return $this->fetch("edit");
    }
    
    
    
    /**
     * 导出
     * @param Request $request
     */
    public function export(Request $request) {
        $selectToConfig = ConfigModel::selectToConfig($request->param("ids/a"));
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
            $statusUpdate = ConfigModel::updateByConfigType($request->param("id/a"),$request->param("value/a"));
            if($statusUpdate){
                $this->success("操作成功");
            }
            $this->error("操作失败");
        }
        $selectByConfigType = ConfigModel::selectByConfigType($ConfigType);
        $this->assign("info_list",$selectByConfigType);
        return $this->fetch("config");
    }


    /**
     * 支付配置
     * @param Request $request
     * @return type
     */
    public function payment(Request $request) {
        return $this->setConfig($request, ConfigModel::CONFIG_PAYMENT);
    }
    /**
     * 短信配置
     * @param Request $request
     * @return type
     */
    public function message(Request $request) {
        return $this->setConfig($request, ConfigModel::CONFIG_MESSAGE);
    }
    /**
     * 邮件配置
     * @param Request $request
     * @return type
     */
    public function mail(Request $request) {
        return $this->setConfig($request, ConfigModel::CONFIG_MAIL);
    }
    
}
