<?php

namespace application\admin\controller;

/**
 * @author ROL
 * @date 2016-11-8 14:50:08
 * @version V1.0
 * @desc   
 */
class Brand extends Admin{
    
    /**
     * 品牌列表
     * @return type
     */
    public function index(){
        $title = trim(input('title'));
        $page = trim(input('page'));
        $ActionLog = new ActionLog();
        $lists = $ActionLog->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
}
