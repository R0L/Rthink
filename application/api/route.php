<?php

 
return [
    
    //http://tp.jh/api/v1/sendsms?sign=xx&terminal=2
    '[api]'     => [
        '__miss__'  => 'api/error/miss',
        ':version/sendSms'   => ['api/:version.user/sendSms',['method'=>'post']],
        ':version/verifiCode'   => ['api/:version.user/verifiCode',['method'=>'post']],
        ':version/updatePassword'   => ['api/:version.user/updatePassword',['method'=>'post']],
        ':version/addUserInCode'   => ['api/:version.user/addUserInCode',['method'=>'post']],
        ':version/getUserInfo/:userId'   => ['api/:version.user/getUserInfo',['method'=>'get']],
        ':version/updatePortrait'   => ['api/:version.user/updatePortrait',['method'=>'post']],
    ],
    
    
];