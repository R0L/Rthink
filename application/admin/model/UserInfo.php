<?php
namespace application\admin\model;
/**
 * @author ROL
 * @date 2016-11-10 11:07:35
 * @version V1.0
 * @desc   
 */
class UserInfo extends Base {
    protected $autoWriteTimestamp = false;
     //自动完成
    protected $auto = [];
    protected $insert = [];  
    protected $update = [];
    
    protected function base($query) {
    }
}
