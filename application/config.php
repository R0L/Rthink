<?php

return [
    'app_namespace' => 'application',
    'app_debug' => true,
    'app_trace' => true,
    'trace' => [
        'type' => 'Html',
    ],
    'default_module' => 'admin',
    'default_validate' => '',
    'log' => [
        'type' => 'File',
        'path' => LOG_PATH,
        'level' => [],
    ],
    'addons' => [
        'testhook' => 'test',
        'uploadhook' => 'upload',
        'editorforadminhook' => 'editorforadmin',
    ],
];