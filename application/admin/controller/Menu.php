<?php

namespace application\admin\controller;

use application\admin\model\Menu as MenuModel;

class Menu extends Admin {

    /**
     * 后台菜单首页
     */
    public function index() {
        $pid = input('pid', 0);
        $title = trim(input('title'));
        $page = trim(input('page'));

        $this->assign('meta_title', '菜单列表');

        $Menu = new MenuModel();
        if (empty($pid)) {
            $data = $Menu->get($pid);
            $this->assign('data', $data);
        }
        
        $lists = $Menu->where(["pid" => "{$pid}"])->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    public function add(){
        $this->assign('info',array('pid'=>input('pid')));
        
        $Menu = new MenuModel();
        $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $Menu->getMenu());
        $this->assign('Menus', $menus);
        $this->assign('meta_title','新增菜单');
        return $this->fetch('edit');
    }

}
