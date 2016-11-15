<?php
namespace application\admin\model;
/**
 * @author ROL
 * @date 2016-11-10 10:18:29
 * @version V1.0
 * @desc   
 */
class AuthRule extends Base{
    
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
    
    /**
     * AuthRule中的父类
     * @return type
     */
    public function authrule(){
        return $this->hasOne('AuthRule',"id","pid");
    }
}
