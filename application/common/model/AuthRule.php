<?php
namespace application\common\model;
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
     * 菜单显示的状态
     * @param type $is_menu
     * @param type $data
     * @return string
     */
    public function getIsMenuTextAttr($is_menu, $data) {
        if (empty($is_menu)) {
            $is_menu = $data["is_menu"];
        }
        $op_status = [0 => '隐藏', 1 => '显示'];
        return $op_status[intval($is_menu)];
    }
    
    /**
     * AuthRule中的父类
     * @return type
     */
    public function authrule(){
        return $this->hasOne('AuthRule',"id","pid");
    }
}
