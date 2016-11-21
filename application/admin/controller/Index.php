<?php

namespace application\admin\controller;

use JasonRoman\Flot\Flot;
/**
 * @author ROL
 * @date 2016-10-29 11:55:16
 * @version V1.0
 * @desc   
 */
class Index extends Admin {

    
    public function index() {
        $flot = new Flot;
        $data = array('2014-01-01 12:00:00' => 5, '2014-06-01 12:00:00' => 10);
        $flotData = $flot->convert($data, 'vertical', $datetime = true);
        $this->assign("chart", $flotData);
        return $this->fetch();
    }
    
}
