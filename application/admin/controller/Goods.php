<?php

namespace application\admin\controller;
use application\admin\model\Goods as GoodsModel;
use application\admin\model\Brand;
use application\admin\model\Category;
/**
 * @author ROL
 * @date 2016-11-8 14:50:08
 * @version V1.0
 * @desc   
 */
class Goods extends Admin{
    
    /**
     * 全部商品展示页面
     * @return type
     */
    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if(!empty($title)){
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $goods_status = trim(input('goods_status'));
        if(!empty($goods_status)){
            $map["goods_status"] = $goods_status;
        }
        $Goods = new GoodsModel();
        $lists = $Goods->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    
    
    public function dd() {
        $map = array();
        $map["status"] = 1;
        $map["goods_status"] = 1;
        $map["total_time"] = ["elt","buy_time"];
        $title = trim(input('title'));
        if(!empty($title)){
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $Goods = new GoodsModel();
        $lists = $Goods->where($map)->paginate();
        dump($lists);
        $this->assign('lists', $lists);
        return $this->fetch("index");
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
