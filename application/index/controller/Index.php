<?php

namespace application\index\controller;

use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use PHPExcel;
use PHPExcel_IOFactory;

class Index extends Base {

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
        $this->assign("data", "测试");
        return $this->fetch("index");
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


}
