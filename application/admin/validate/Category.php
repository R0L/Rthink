<?php
namespace application\admin\validate;

/**
 * @author ROL
 * @date 2016-11-8 15:39:08
 * @version V1.0
 * @desc   
 */
class Category extends Base {
    protected $rule = [
        'title'=>'require|max:50',
    ];
    protected $message = [
        'title.require'=>'栏目标题不能为空',
    ];
    
    protected $scene = [
        
    ];
}
