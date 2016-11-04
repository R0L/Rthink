<?php

return [
    'app_namespace' => 'application',
    'app_debug' => true,
    'app_trace' => true,
    'default_module' => 'admin',
    'default_validate' => '',
    'log' => [
        'type' => 'File',
        'path' => LOG_PATH,
        'level' => [],
    ],
    'trace' => [
        'type' => 'Html',
    ],
    'addons' => [
        'testhook' => 'test',
        'uploadhook' => 'upload',
        'editorforadminhook' => 'editorforadmin',
    ],
];
