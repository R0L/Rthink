<?php
namespace application\common\model;
/**
 * @author ROL
 * @date 2016-11-10 15:08:50
 * @version V1.0
 * @desc   
 */
class Channel extends Base {
    
    /**
     * 获取是否新窗口
     * @param type $target
     * @param type $data
     * @return string
     */
    public function getTargetTextAttr($target, $data) {
        if (empty($target)) {
            $target = $data["target"];
        }
        $op_status = [0 => '否', 1 => '是'];
        return $op_status[intval($target)];
    }
    
}
