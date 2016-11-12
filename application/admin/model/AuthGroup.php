<?php
namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-10 10:16:46
 * @version V1.0
 * @desc   
 */
class AuthGroup extends Base {
    protected $autoWriteTimestamp = false;
     //自动完成
    protected $auto = [];
    protected $insert = ['status' => 1];  
    protected $update = [];
}
