<?php
namespace addons\editorforadmin\controller;
use Think\Controller;
use ROL\Upload;

class EditorUpload extends Controller{

    public $uploader = null;

    /* 上传图片 */
    public function upload() {
        session('upload_error', null);
        /* 上传配置 */
        $setting = config('EDITOR_UPLOAD');

        $driver = config('PICTURE_UPLOAD_DRIVER');
        /* 调用文件上传组件上传文件 */
        $this->uploader = new Upload($setting, $driver);
        $info = $this->uploader->upload($_FILES);
        if ($info) {
            $url = config('EDITOR_UPLOAD.rootPath') . $info['imgFile']['savepath'] . $info['imgFile']['savename'];
            $url = str_replace('./', '/', $url);
            $info['fullpath'] = $url;
        }
        session('upload_error', $this->uploader->getError());
        return $info;
    }

    //keditor编辑器上传图片处理
    public function ke_upimg() {
        /* 返回标准数据 */
        $return = array('error' => 0, 'info' => '上传成功', 'data' => '');
        $img = $this->upload();
        /* 记录附件信息 */
        if ($img) {
            $return['url'] = $img['fullpath'];
            unset($return['info'], $return['data']);
        } else {
            $return['error'] = 1;
            $return['message'] = session('upload_error');
        }

        /* 返回JSON数据 */
        exit(json_encode($return));
    }

    //ueditor编辑器上传图片处理
    public function ue_upimg() {
        $img = $this->upload();
        $return = array();
        $return['url'] = $img['fullpath'];
        $title = htmlspecialchars(input('post.pictitle'), ENT_QUOTES);
        $return['title'] = $title;
        $return['original'] = $img['imgFile']['name'];
        $return['state'] = ($img) ? 'SUCCESS' : session('upload_error');
        /* 返回JSON数据 */
        return json($return);
        
    }

}
