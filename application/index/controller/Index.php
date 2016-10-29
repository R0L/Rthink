<?php

namespace application\index\controller;

use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;

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

}
