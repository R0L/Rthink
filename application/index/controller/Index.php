<?php

namespace application\index\controller;

use application\common\controller\Common;
use Workerman\Lib\Timer;

class Index extends \think\worker\Server {

    protected $socket = 'websocket://localhost:2346';
    
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data) {
        $to = 'workerman@workerman.net';
        $content = 'hello workerman';
        // 10秒后执行发送邮件任务，最后一个参数传递false，表示只运行一次
        Timer::add(10, 'send_mail', array($to, $content), false);
    }

}
