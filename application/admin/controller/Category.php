<?php

namespace application\admin\controller;

use application\admin\model\Category as CategoryModel;

/**
 * @author ROL
 * @date 2016-11-8 9:38:18
 * @version V1.0
 * @desc   
 */
class Category extends Admin {
    
    private $operator_model;
    public function _initialize(){
        parent::_initialize();
        $this->operator_model = new CategoryModel();
    }
    
    /**
     * 商品分类展示页面
     * @return type
     */
    public function index() {
        $title = trim(input('title'));
        $page = trim(input('page'));
        $lists = $this->model->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    
    public function add() {
        if(request()->isPost()){
            $result = $this->operator_model->validate(true)->save();
            if(!$result){
                dump($this->operator_model->getError());
            }
        }else{
            return $this->fetch("edit");
        }
    }
    
    public function edit() {
        return $this->fetch();
    }
    
}
