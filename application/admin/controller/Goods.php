<?php

namespace application\admin\controller;
use application\common\model\Goods as GoodsModel;
use application\common\logic\Category;
use application\common\model\Brand;
use think\Request;
/**
 * @author ROL
 * @date 2016-11-8 14:50:08
 * @version V1.0
 * @desc   
 */
class Goods extends Admin{
    
    /**
     * 商品展示公有方法
     * @param Request $request
     * @param type $goods_status
     * @return type
     */
    public function index(Request $request,$goods_status) {
        $map = [];
        if(empty($goods_status)){
            $goods_status = $request->param("goods_status",0);
        }
        if($title = $request->param("title")){
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $map["goods_status"] = $goods_status;
        $lists = GoodsModel::paginate($map);
        $this->assign('lists', $lists);
        $this->assign('goods_status', $goods_status);
        return $this->fetch("index");
    }
    
    
    /**
     * 待审核
     * @param Request $request
     * @return type
     */
    public function nochecked(Request $request) {
        return $this->index($request, GoodsModel::GOODS_NOCHECKED);
    }
    /**
     * 已审核/待上线
     * @param Request $request
     * @return type
     */
    public function checked(Request $request) {
        return $this->index($request, GoodsModel::GOODS_CHECKED);
    }
    /**
     * 已上线/夺宝中
     * @param Request $request
     * @return type
     */
    public function online(Request $request) {
        return $this->index($request, GoodsModel::GOODS_ONLINE);
    }
    /**
     * 已结束
     * @param Request $request
     * @return type
     */
    public function complete(Request $request) {
        return $this->index($request, GoodsModel::GOODS_COMPLETE);
    }
    
    
    
    /**
     * 商品添加
     * @param Request $request
     */
    public function add(Request $request) {
      if ($request->isPost()) {
          $this->opReturn(GoodsModel::create($request->param()), "goods/nochecked");
        }
        //返回栏目
        $this->assign("category_list",Category::selectToCategoryTree());
        //返回品牌
        $this->assign("brand_list",Brand::all());

        return $this->fetch("edit");
    }
    
    /**
     * 商品编辑
     * @param Request $request
     */
    public function edit(Request $request) {
        if ($request->isPost()) {
            $this->opReturn(GoodsModel::update($request->except("file")));
        } 
        $this->assign("info", GoodsModel::get($request->param("id")));

        //返回栏目
        $this->assign("category_list",Category::selectToCategoryTree());
        //返回品牌
        $this->assign("brand_list",Brand::all());

        return $this->fetch("edit");
    }
    
    /**
     * 删除商品
     * @param Request $request
     */
    public function del(Request $request) {
       $this->opReturn(GoodsModel::delByIds($request->param('param.id/a')));
    }
    
}
