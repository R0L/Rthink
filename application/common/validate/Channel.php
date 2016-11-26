<?php
namespace application\common\validate;

/**
 * @author ROL
 * @date 2016-11-8 15:39:08
 * @version V1.0
 * @desc   
 */
class Channel extends Base {
    
    protected $rule = [
        'title'=>'require|max:30',
        'url'=>'require|max:100',
        'sort'=>'require|number',
    ];
    protected $message = [
        'title.require' => '导航名称不能为空',
        'title.max' => '导航名称最长为30字符',
        'url.require' => '导航链接不能为空',
        'url.max' => '导航链接最长为30字符',
    ];
    
    protected $scene = [
        
    ];
    
}
