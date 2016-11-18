<?php

namespace application\admin\controller;
use think\Request;
use application\admin\model\Picture;
use application\common\controller\Attach as CommonAttach;
/**
 * @author ROL
 * @date 2016-11-17 13:32:53
 * @version V1.0
 * @desc   
 */
class Attach extends Admin {
    
    
    public function picture(Request $request) {
        $lists = Picture::paginate($request->except("page"));
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    /**
     * 上传图片
     * @param Request $request
     * @return type
     */
    public function upload(Request $request) {
        $commonAttach = new CommonAttach();
        $pic_id = $commonAttach->uploadPicture($request);
        return json(["pic_id"=>$pic_id]);
    }
    
}
