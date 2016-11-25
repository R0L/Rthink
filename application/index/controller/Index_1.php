<?php

namespace application\index\controller;
use application\common\controller\Common;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use PHPExcel;
use PHPExcel_IOFactory;
use think\File;

class Index extends Common {

    public function index() {

//        $client = new Client(new App(Config::get("sms_alidayu")));
//        $req = new AlibabaAliqinFcSmsNumSend;
//        $req->setRecNum('13281563075')
//                ->setSmsParam(['number' => rand(100000, 999999)])
//                ->setSmsFreeSignName('叶子坑')
//                ->setSmsTemplateCode('SMS_15105357');
//
//        $resp = $client->execute($req);
//
//        print_r($resp);
//        print_r($resp->result->model);
//        $this->assign("data", "测试");
//        $this->assign('demo_time',$this->request->time());
//        return $this->fetch("index");
        echo "index/index/index";
    }

    public function push() {
        $umeng = new \ROL\Umeng\Umeng("55611cba67e58e9f37006d90", "g3hbjscivkmycrwvyvbmuewekl6u1ch4");
        $umeng->sendAndroidUnicast();
    }

    public function execl() {
        $data = array(
            array(NULL, 2010, 2011, 2012),
            array('Q1', 12, 15, 21),
            array('Q2', 56, 73, 86),
            array('Q3', 52, 61, 69),
            array('Q4', 30, 32, 0),
        );

        create_xls($data);
    }

    
    public function upload() {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        
        
        dump($file);
            exit();
        
        if ($info) {
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
    
    public function _empty() {
        return "操作不存在";
    }
    

}
