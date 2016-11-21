<?php
namespace application\common\model;
/**
 * @author ROL
 * @date 2016-11-17 11:42:26
 * @version V1.0
 * @desc   
 */
class Amap extends Base{
    
     //自动完成
    protected $auto = [];
    protected $insert = [];  
    protected $update = [];  
    
     // 定义全局的查询范围
    protected function base($query) {
    }
}
