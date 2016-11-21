<?php
namespace application\common\validate;

/**
 * @author ROL
 * @date 2016-11-8 15:39:08
 * @version V1.0
 * @desc   
 */
class Brand extends Base {
    protected $rule = [
        'title'=>'require|max:50',
    ];
    protected $message = [
        'title.require'=>'品牌标题不能为空',
    ];
    
    protected $scene = [
        
    ];
}
