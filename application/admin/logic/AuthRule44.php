<?php

namespace application\admin\logic;

use application\admin\model\AuthRule as AuthRuleModel;
use application\common\model\Tree;
/**
 * @author ROL
 * @date 2016-11-12 9:55:06
 * @version V1.0
 * @desc   
 */
class AuthRule extends AuthRuleModel {

    /**
     * 通过$module返回所有的AuthRule
     * @param type $module
     * @return type
     */
    public function selectByModule($module=null,$ischeck=false) {
        $map =  [];
        $module&&$map["module"] = $module;
        $Tree = new Tree();
        
        if($ischeck){
            
        }
        
        return $Tree->toTree(AuthRuleModel::all($map));
    }

    /**
     * 根据$name把AuthRule的status重置为0
     * @param type $name
     * @return type
     */
    public function updateByName($name) {
        return AuthRuleModel::update(["status" => 0], ["name" => $name]);
    }

    /**
     * 通过$name获取AuthRule
     * @param type $name
     * @return type
     */
    public function findByName($name) {
        return AuthRuleModel::get(["name" => $name]);
    }

    /**
     * 添加AuthRule
     * @param type $data
     * @return type
     */
    public function add($data) {
        return AuthRuleModel::create($data);
    }

    /**
     * 根据$module和$menu来添加AuthRule
     * @param type $module
     * @param type $menu
     * @return type
     */
    public function addAuthRule($module, $menu) {
        $name = $module . "/" . $menu["url"];
        $findByName = $this->findByName($name);
        if (empty($findByName)) {
            $data["title"] = $menu["title"];
            $data["type"] = 1;
            $data["module"] = $module;
            $data["name"] = $name;
            $data["status"] = $menu["status"];
            return $this->add($data);
        }
    }

    /**
     * 更新规则
     * @param type $module
     * @return boolean
     */
    public function updateRules($module) {
        $Menu = new Menu();
        $MenuAll = $Menu->all();
        foreach ($MenuAll as $menu) {

            if (empty($menu->status)) {
                $this->updateByName($module . "/" . $menu->url);
                continue;
            }
            $this->addAuthRule($module, $menu);
        }
        return true;
    }

    
    /**
     * 获得菜单
     * @return type
     */
    public function getMenu() {
        return $this->selectByModule();
    }
    
    
}
