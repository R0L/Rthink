<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-10 10:18:08
 * @version V1.0
 * @desc   
 */
class AuthGroupAccess extends Base {
    
    protected $autoWriteTimestamp = false;
     //自动完成
    protected $auto = [];
    protected $insert = [];  
    protected $update = [];
    
    // 定义全局的查询范围
    protected function base($query) {}
    
    /**
     * AuthGroupAccess 中的用户信息
     * @return type
     */
    public function member(){
        return $this->belongsTo('application\common\model\Member',"uid","id");
    }
    
    
}
