<?php

namespace application\common\controller;

use application\common\model\Picture;
use think\Config;
use think\Request;
use think\Exception;

/**
 * @author ROL
 * @date 2016-11-18 11:41:46
 * @version V1.0
 * @desc   
 */
class Attach extends Base {

    /**
     * 默认配置
     * @var type 
     */
    private $default_setting = [
        'mimes' => array(), //允许上传的文件MiMe类型
        'maxSize' => 0, //上传的文件大小限制 (0-不做限制)
        'ext' => 'jpg,gif,png,jpeg', //允许上传的文件后缀
        'savePath' => './Uploads' . DS . 'Picture'.DS, //保存路径
        'saveName' => 'uniqid', //上传文件命名规则
        'replace' => false, //存在同名是否覆盖
        'callback' => false, //检测文件是否存在回调，如果存在返回文件信息数组
        'driver' => '', // 文件上传驱动
        'driverConfig' => array(), // 上传驱动配置
    ];

    /**
     * 文件上传
     * @param Request $request
     * @return type
     */
    public function uploadPicture(Request $request) {
        $setting = array_merge($this->default_setting, Config::get("picture_upload"));
        $file = $request->file('file');
        if (empty($file)) {
            throw new Exception("请选择上传文件");
        }
        $exists = Picture::isExists(["md5" => $file->hash("md5"), "sha1" => $file->hash("sha1")]);
        if ($exists) {
            return $exists;
        }
        $info = $file
                ->validate(['ext' => $setting['ext'], 'size' => $setting['size']])
                ->rule($setting['saveName'])
                ->move($setting['savePath'], true, $setting['replace']);
        if ($info) {
            $data['path'] = substr($setting['savePath'], 1) . $info->getSaveName(); //在模板里的url路径
            $data['md5'] = $info->hash('md5');
            $data['sha1'] = $info->hash('sha1');
            $add = Picture::add($data);
            if($add){
                return $add;
            }
        }
        throw new Exception($file->getError());
    }

}
