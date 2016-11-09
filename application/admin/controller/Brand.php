<?php

namespace application\admin\controller;
use application\admin\model\Brand as BrandModel;
use application\admin\model\Category;
/**
 * @author ROL
 * @date 2016-11-8 14:50:08
 * @version V1.0
 * @desc   
 */
class Brand extends Admin{
    
    /**
     * 品牌展示页面
     * @return type
     */
    public function index() {
        $title = trim(input('title'));
        $Brand = new BrandModel();
        $lists = $Brand->where(["status" => 1, "title" => ["like", "%" . $title . "%"]])->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    public function deal() {
        $Brand = new BrandModel();
        if (request()->isPost()) {
            if ($Brand->deal(input())) {
                $this->success("操作成功", url("index"));
            }
            $this->error("操作失败:" . $Brand->getError());
        } else {
            
            //返回终极栏目
            $Category = new Category();
            $this->assign("categorys",$Category->getLastLevelCategory());
            
            ($id = input("param.id")) ? $this->assign("info", $Brand->get($id)) : "";
            return $this->fetch("edit");
        }
    }

    public function del() {
        $id = array_unique((array) input('param.id/a'), 0);
        empty($id) && $this->error("不存在参数ID");
        $Brand = new BrandModel();
        $staus_deal = $Brand->save(["status" => -1], ["id" => ["in", $id]]);
        if ($staus_deal) {
            $this->success("操作成功", url("index"));
        }
        $this->error("操作失败:" . $Brand->getError());
    }
    
}
