<?php

namespace application\index\controller;
use Workerman\Lib\Timer;
use application\common\service\Period;

class Index extends \think\worker\Server {

    protected $socket = 'websocket://localhost:2346';
    
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data) {
        Timer::add(600, function(){
            
            
            
        }, NULL, true);
    }

}
