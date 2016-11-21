<?php
namespace application\common\model;

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
    
    // 定义全局的查询范围
    protected function base($query) {
        $map['status'] = 1;
        $query->where($map);
    }
}
