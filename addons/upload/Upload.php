<?php

namespace addons\upload;

use think\addons\Addons;

/**
 * 图片批量上传插件
 * @author tjr&jj
 */
class Upload extends Addons {

    public $info = array(
        'name' => 'uploadImages',
        'title' => '图片批量上传',
        'description' => '图片的批量上传',
        'status' => 1,
        'author' => 'brighttj',
        'version' => '0.3'
    );

    public function install() {
        //添加钩子
//        $updateImagesHooks =array(
//                'name' => 'uploadImages',
//                'description' => '多图片上传的钩子',
//                'type' => 1,
//                'update_time' => NOW_TIME,
//                'addons' => 'UploadImages'
//        );
//        $insert = Db::name('hooks')->insert($updateImagesHooks);
//        if (empty($insert)) {
//            session('addons_install_error', $insert);
//            return false;
//        }
        return true;
    }

    public function uninstall() {
//        $hooks = Db::name('hooks');
//        $map['name'] = "uploadImages";
//        $find = $hooks->where($map)->find();
//        if ($find) {
//            $res = $hooks->where($map)->delete();
//            if ($res == false) {
//                session('addons_install_error', $res);
//                return false;
//            }
//        }
        return true;
    }

    //实现的uploadImages钩子方法
    public function uploadhook($data) {
        $this->assign('addons_data', $data);
        return $this->fetch('upload');
    }

}
