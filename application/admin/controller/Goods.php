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
    
    
    public function dd() {
        $map = array();
        $map["status"] = 1;
        $map["goods_status"] = 1;
        $map["buy_time"] = ["egt","total_time"];
        $title = trim(input('title'));
        if(!empty($title)){
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $Goods = new GoodsModel();
        $lists = $Goods->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch("index");
    }
    
    
    
    /**
     * 商品添加
     * @param Request $request
     */
    public function add(Request $request) {
        return $this->deal($request);
    }
    
    /**
     * 商品编辑
     * @param Request $request
     */
    public function edit(Request $request) {
        return $this->deal($request);
    }
    
    /**
     * 商品的操作
     * @param Request $request
     * @return type
     */
    private function deal(Request $request) {
        if ($request->isPost()) {
            $statusDeal = GoodsModel::deal($request->except("file"));
            if ($statusDeal) {
                $this->success("操作成功", "nochecked");
            }
            $this->error("操作失败:");
        } else {
            $id = $request->param("id");
            if($id){
                $goodsGet = GoodsModel::getLineData($id);
                $this->assign("info", $goodsGet);
            }
            
            //返回栏目
            $selectToCategory = Category::selectToCategoryTree();
            $this->assign("category_list",$selectToCategory);
            //返回品牌
            $all = Brand::all();
            $this->assign("brand_list",$all);
            
            return $this->fetch("edit");
        }
    }

    /**
     * 删除商品
     * @param Request $request
     */
    public function del(Request $request) {
        $delByIds = GoodsModel::delByIds($request->param('param.id/a'));
        if ($delByIds) {
            $this->success("操作成功", "index");
        }
        $this->error("操作失败:");
    }
    
}
