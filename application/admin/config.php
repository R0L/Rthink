<?php
return [
    'view_replace_str' => array(
        '__ROOT__' => '/',
        '__ADDONS__' => '/addons',
        '__STATIC__' => '/static',
        '__CSS__' => '/admin/css',
        '__JS__' => '/admin/js',
        '__IMG__' => '/admin/images',
    ),
    'default_filter' => ['strip_tags', 'htmlspecialchars'],
    'editor_upload' => array(
        'mimes' => '',
        'maxSize' => 2 * 1024 * 1024,
        'exts' => 'jpg,gif,png,jpeg',
        'autoSub' => true,
        'subName' => array('date', 'Y-m-d'),
        'rootPath' => './Uploads/Editor/',
        'savePath' => '',
        'saveName' => array('uniqid', ''),
        'saveExt' => '',
        'replace' => false,
        'hash' => true,
        'callback' => false,
    ),
    'picture_upload_driver' => 'local',
    'upload_local_config' => array(
    ),'picture_upload' => array(
        'size' => 2 * 1024 * 1024,
        'ext' => 'jpg,gif,png,jpeg',
        'rootPath' => './Uploads/Picture/',
        'replace' => false,
        'saveName' => array('uniqid', '')
    ),
    'picture_upload_driver' => 'local',
    'upload_local_config' => array(
    ),
    'upload_bcs_config' => array(
        'AccessKey' => '',
        'SecretKey' => '',
        'bucket' => '',
        'rename' => false
    ),
    'paginate' => [
        'type' => 'bootstrap',
        'var_page' => 'page',
        'list_rows' => 10,
    ],
    'cache' => [
        'type' => 'File',
        'path' => CACHE_PATH,
        'prefix' => '',
        'expire' => 0,
    ],
    'session' => [
        'id' => '',
        'var_session_id' => '',
        'prefix' => 'think',
        'type' => '',
        'auto_start' => true,
    ],
    'cookie' => [
        'prefix' => 'yyg_admin_',
        'expire' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => '',
        'setcookie' => true,
    ],
//    'dispatch_error_tmpl' => APP_PATH . 'admin' . DS . 'view' . DS . 'public' . DS . 'error.html',
//    'dispatch_success_tmpl' => APP_PATH . 'admin' . DS . 'view' . DS . 'public' . DS . 'success.html',
    
    'mail'=>[
        /**
         * ;extension=php_openssl.dll
         * 1：开启服务：POP3/SMTP服务 (如何使用 Foxmail 等软件收发邮件？) 已开启 | 关闭
         * 2：登录密码不是QQ登录密码 也不是独立密码 而是 （温馨提示：登录第三方客户端时，密码框请输入“授权码”进行验证。生成授权码） 这个授权码 授权码 可以发短信获得 或者装了QQ手机令牌的 直接可以获得！
         * 3：QQ邮箱发送邮件服务器：smtp.qq.com，使用SSL，端口号465或587
         * 设置 下面参数即可
         * $mail->Port = '465'; 
         * $mail->SMTPSecure = 'ssl'; 
         */
        'host' =>'smtp.qq.com',//邮箱的SMTP服务器地址，如果是QQ的则为：smtp.qq.com
        'mailer' =>"SMTP", //
        'smtpauth' =>true, //启用smtp认证
        'smtpsecure' =>'ssl', //是否验证 ssl 与接口对应  (port:465->smtpsecure:ssl,port:25->smtpsecure:'',port:587->smtpsecure:'tls')
        'port' =>465, //tls/ssl
        'username' =>'1280641010@qq.com',//你的邮箱名
        'from' =>'1280641010@qq.com',//发件人地址
        'fromname'=>'李瑞',//发件人姓名
        'password' =>'snkucidepeyniebb',//邮箱密码
        'charset' =>'UTF-8',//设置邮件编码
        'ishtml' =>true, // 是否html格式邮件
    ]
    
    
];
