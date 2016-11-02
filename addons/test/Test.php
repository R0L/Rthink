<?php

namespace addons\test;

use think\addons\Addons;

/**
 * @author ROL
 * @date 2016-10-31 9:58:23
 * @version V1.0
 * @desc   
 */
class Test extends Addons {

    public $info = [
        'name' => 'test',
        'title' => '插件测试',
        'description' => 'thinkph5插件测试',
        'status' => 0,
        'author' => 'ROL',
        'version' => '0.1'
    ];

    public function install() {
        return true;
    }

    public function uninstall() {
        return true;
    }

    public function testhook($param) {
        // 调用钩子时候的参数信息
        print_r($param);
        // 当前插件的配置信息，配置信息存在当前目录的config.php文件中，见下方
        print_r($this->getConfig());
        // 可以返回模板，模板文件默认读取的为插件目录中的文件。模板名不能为空！
        return $this->fetch('info');
    }
}
