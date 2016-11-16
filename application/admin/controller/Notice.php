<?php

namespace application\admin\controller;
use application\admin\model\Notice as NoticeModel;
use \think\Request;

/**
 * @author ROL
 * @date 2016-11-10 15:40:31
 * @version V1.0
 * @desc   通知管理
 */
class Notice extends Admin {
    
    /**
     * 通知列表
     * @param Request $request
     * @return type
     */
    public function noti(Request $request) {
        return $this->noticeList($request,NoticeModel::NOTICE_NOTIFICATION);
    }
    /**
     * 公告列表
     * @param Request $request
     * @return type
     */
    public function anno(Request $request) {
        return $this->noticeList($request,NoticeModel::NOTICE_ANNOUNCEMENT);
    }
    
    
    /**
     * 通知添加
     * @param Request $request
     * @return type
     */
    public function addNoti(Request $request) {
        return $this->deal($request);
    }
    
    /**
     * 通知编辑
     * @param Request $request
     * @return type
     */
    public function editNoti(Request $request) {
        return $this->deal($request);
    }
    
    /**
     * 公告添加
     * @param Request $request
     * @return type
     */
    public function addAnno(Request $request) {
        return $this->deal($request);
    }
    
    /**
     * 公告编辑
     * @param Request $request
     * @return type
     */
    public function editAnno(Request $request) {
        return $this->deal($request);
    }
    
    /**
     * 删除
     * @param Request $request
     */
    public function del(Request $request) {
        $statusDel = NoticeModel::delByIds($request->param("id/a"));
        if($statusDel){
            $this->success("操作成功");
        }
        $this->success("操作失败");
    }
    
    
    
    /**
     * 列表的处理
     * @param Request $request
     * @param type $noticeType
     * @return type
     */
    private function noticeList(Request $request,$noticeType = 0) {
        $map = array();
        $map["notice_type"] = $noticeType;
        if ($title = $request->param("title")) {
            $map["title|content"] = ["like", "%" . $title . "%"];
        }
        $lists = NoticeModel::paginate($map);
        $this->assign('lists', $lists);
        $this->assign('notice_type', $noticeType);
        $this->assign("notice_type_text", NoticeModel::$noticeTypeStstus[$noticeType]);
        return $this->fetch("index");
    }
    
    /**
     * 添加或者编辑的处理
     * @param Request $request
     * @param type $noticeType
     * @return type
     */
    private function deal(Request $request) {
        $notice_type = $request->param("notice_type",0);
        if($request->isPost()){
            $deal = NoticeModel::deal($request->param());
            if($deal){
                $this->success("操作成功",$notice_type?"anno":"noti");
            }
            $this->error("操作失败");
        }
        $id = $request->param("id");
        if($id){
            $noticeGet = NoticeModel::getLineData(["id"=>$id]);
            $this->assign("info", $noticeGet);
        }else{
            $this->assign("info", ["member_id"=>$request->user->id,"pub_id"=>$request->pubuser->id]);
        }
        $this->assign("notice_type_text", NoticeModel::$noticeTypeStstus[$notice_type]);
        return $this->fetch("edit");
    }
}
