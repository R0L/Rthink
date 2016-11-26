<?php

 
return [
    
    //http://tp.jh/api/v1/sendsms?sign=xx&terminal=2
    '[api]'     => [
        '__miss__'  => 'api/error/miss',
        ':version/:pub_id/sendSms/[:mobile]'   => ['api/:version.user/sendSms?mobile=:mobile'],
    ],
    
    
];