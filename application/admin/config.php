<?php

return [
    //模板参数替换
    'view_replace_str' => array(
        '__CSS__' => '/static/admin/css',
        '__JS__' => '/static/admin/js',
        '__IMG__' => '/static/admin/images',
        '__STATIC__' => '/static',
        '__ADDONS__' => '/addons',
        '__ROOT__' => '/',
    ),
    'default_filter' => ['strip_tags', 'htmlspecialchars'],
];
