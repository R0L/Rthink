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
        if($request->isPost()){
            $this->opReturn(SliderModel::create($request->except("file"))."Slider/index");
        }
        return $this->fetch("edit");
    }
    /**
     * 幻灯片编辑
     * @param Request $request
     * @return type
     */
    public function edit(Request $request) {
        if($request->isPost()){
            $this->opReturn(SliderModel::update($request->except("file"))."Slider/index");
        }
        $this->assign("info", SliderModel::get($request->param("id")));
        return $this->fetch("edit");
    }
    
    /**
     * 幻灯片删除
     * @param Request $request
     */
    public function del(Request $request) {
        $this->opReturn(SliderModel::delByIds($request->param("id/a")));
    }
    
}
