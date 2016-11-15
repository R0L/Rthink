<?php

namespace application\admin\controller;
use think\Request;
use application\admin\model\AuthRule as AuthRuleModel;


/**
 * @author ROL
 * @date 2016-11-15 16:09:33
 * @version V1.0
 * @desc   
 */
class AuthRule extends Admin {
    
    /**
     * 后台菜单列表
     */
    public function index(Request $request) {
        $map = [];
        $pid = $request->param("pid", 0);
        $map["pid"] = $pid;
        if (empty($pid)) {
            $data = AuthRuleModel::get($pid);
            $this->assign('data', $data);
        }
        if($title = $request->param("title")){
            $map["title"] = $title;
        }
        $lists = AuthRuleModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    public function add(){
        $this->assign('info',array('pid'=>input('pid')));
//        $menus = array_merge(array(0=>array('id'=>0,'title'=>'顶级菜单')),$Menu->getMenu());
//        $this->assign('Menus', $Menu->getMenu());
        return $this->fetch('edit');
    }
}
