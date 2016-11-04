<?php

namespace application\admin\controller;
use ROL\Upload;
/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */
class File extends Admin {
    /* 文件上传 */

    public function upload() {
        $return = array('status' => 1, 'info' => '上传成功', 'data' => '');
        //TODO: 用户登录检测
        /* 调用文件上传组件上传文件 */
        $file = request()->file('download');
        if (empty($file)) {
            $this->error('请选择上传文件');
        }
        $File = model('file');
        $info = $File->upload($file, config('download_upload'));
        /* 记录文件信息 */
        if ($info) {
            $return['data'] = think_encrypt(json_encode($info));
            $return['info'] = $info['name'];
        } else {
            $return['status'] = 0;
            $return['info'] = $File->getError();
        }
        /* 返回JSON数据 */
        return json($return);
    }

    /* 下载文件 */

    public function download($id = null) {
        if (empty($id) || !is_numeric($id)) {
            $this->error('参数错误！');
        }

        $logic = model('Download', 'Logic');
        if (!$logic->download($id)) {
            $this->error($logic->getError());
        }
    }

    /**
     * 上传图片 
     */
    public function uploadPicture() {
        //TODO: 用户登录检测   
        /* 调用文件上传组件上传文件 */
        $file = request()->file('download');
        if (empty($file)) {
            $this->error('请选择上传文件');
        }
        //TODO:上传到远程服务器 
        $driver = config('PICTURE_UPLOAD_DRIVER');
        $setting = config('PICTURE_UPLOAD');
        /* 调用文件上传组件上传文件 */
        $this->uploader = new Upload($setting, $driver);
        $info = $this->uploader->upload($_FILES);
         /* 记录图片信息 */
        $return['status'] = 0;
        if ($info) {
            $Picture = model('Picture');
            $info = $Picture->upload($file,$setting);
            if ($info) {
                $return['status'] = 1;
                $info['path'] = $info['path'];
                $return = array_merge($info, $return);
            } else {
                $return['info'] = $Picture->getError();
            }
        }
        /* 返回JSON数据 */
        return json($return);
    }

}
