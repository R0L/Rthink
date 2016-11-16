<?php

namespace application\admin\controller;

use think\Controller;
use think\Request;
use application\admin\service\Member;
use think\Session;

/**
 * @author ROL
 * @date 2016-11-11 14:10:49
 * @version V1.0
 * @desc   
 */
class Common extends Controller {

    public function login(Request $request) {

        if ($request->isPost()) {

            $validate = $this->validate($request->post(), "Member");

            if ($validate != true) {
                $this->error($validate);
            }

            if (!captcha_check($request->post("code"))) {
                $this->error("验证码验证失败");
            };

            $Member = new Member();

            $Result = $Member->getMemberByUserName($request->post("user_name"));

            if (empty($Result)) {
                $this->error("用户账号不存在");
            }

            if ($Result->password != $request->post("password")) {
                $this->error("密码验证失败");
            }

            Session::set('user_id', $Result->id);

            return $this->redirect("index/index");
        }

        return $this->fetch("user/login");
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

    public function mail() {

        $send_mail = send_mail("2080775740@qq.com", "测试测试", "测试测试测试测试测试测试");

        dump($send_mail);
    }

    public function Chuanglan() {
        $ChuanglanSMS = new \ROL\Chuanglan\ChuanglanSMS("国讯通");

        $ChuanglanSMS->sendVoice("13281563075", "4546");
    }
    
    
    public function upload() {
            return $this->fetch();
      
    }
    public function uu() {
        $file = request()->file('file');
        return json(["data"=>$file->getFilename()]);
    }
    
}
