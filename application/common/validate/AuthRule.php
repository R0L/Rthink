<?php

namespace application\common\validate;

/**
 * @author ROL
 * @date 2016-11-22 15:25:11
 * @version V1.0
 * @desc   
 */
class AuthRule extends Base {
    protected $rule = [
        'title'=>'require|max:20',
        'name'=>'max:80',
        'pid'=>'require',
        'display'=>'require',
        'sort'=>'require',
    ];
    protected $message = [
        'title.require'=>'菜单名称不能为空',
        'title.max'=>'菜单名称最大长度为20字符',
        'name.max'=>'菜单链接最大长度为80字符',
        'pid'=>'父级菜单不能为空',
        'display'=>'菜单显示不能为空',
        'sort'=>'菜单排序不能为空',
    ];
    
    protected $scene = [
        
    ];
}
