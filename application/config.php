<?php

return [
    'app_namespace' => 'application',
    'app_debug' => true,
    'app_trace' => true,
    'trace' => [
        'type' => 'Html',
    ],
    'route_config_file'      => ['route','api'. DS .'route'],
    'default_module' => 'index',
    'default_validate' => '',
    'log' => [
        'type' => 'File',
        'path' => LOG_PATH,
        'level' => [],
    ],
    'template'             => [
        'taglib_pre_load' => 'application\\common\\taglib\\My'
    ],
    
    'picture_upload' => [],
];


            