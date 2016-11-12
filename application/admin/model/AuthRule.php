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
    
    /**
     * AuthRule中的父类
     * @return type
     */
    public function authrule(){
        return $this->hasOne('AuthRule',"id","pid");
    }
}
