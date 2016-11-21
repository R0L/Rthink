<?php

namespace application\admin\controller;
use application\common\model\Slider as SliderModel;
use think\Request;
/**
 * @author ROL
 * @date 2016-11-10 15:20:09
 * @version V1.0
 * @desc   
 */
class Slider  extends Admin{
    
    /**
     * 幻灯片管理列表展示
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        $map = [];
        if ($title = $request->param("title")) {
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $lists = SliderModel::paginate($map);
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    /**
     * 幻灯片添加
     * @param Request $request
     * @return type
     */
    public function add(Request $request) {
        return $this->deal($request);
    }
    /**
     * 幻灯片编辑
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        return $this->deal($request);
    }
    
    /**
     * 幻灯片删除
     * @param Request $request
     */
    public function del(Request $request) {
        $delByIds = SliderModel::delByIds($request->param("id/a"));
        if($delByIds){
            $this->success("操作成功");
        }
        $this->error("操作失败");
    }
    
    /**
     * 幻灯片管理编辑或者添加
     * @param Request $request
     * @return type
     */
    private function deal(Request $request){
        if($request->isPost()){
            $statusDeal = SliderModel::deal($request->except("file"));
            if($statusDeal){
                $this->success("操作成功","index");
            }
            $this->error("操作失败");
        }
        $id = $request->param("id");
        if($id){
            $sliderGet = SliderModel::getLineData(["id"=>$id]);
            $this->assign("info", $sliderGet);
        }else{
            $this->assign("info", ["member_id"=>$request->user->id,"pub_id"=>$request->pubuser->id]);
        }
        return $this->fetch("edit");
    }
    
    
}
