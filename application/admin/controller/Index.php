<?php

namespace application\admin\controller;
/**
 * @author ROL
 * @date 2016-10-29 11:55:16
 * @version V1.0
 * @desc   
 */
class Index extends Admin {

    
    public function index() {
        return $this->fetch();
    }
    
}
