<?php

 
return [
    
//    '__rest__'  =>  [
//        'api/:version/address' =>  'api/:version.address',
//    ],
    
    //http://tp.jh/api/v1/sendsms?sign=xx&terminal=2
    '[api]'     => [
        '__miss__'  => 'api/error/miss',
        
        //用户
        ':version/sendsms'   => ['api/:version.user/sendSms',['method'=>'post']],
        ':version/verificode'   => ['api/:version.user/verifiCode',['method'=>'post']],
        ':version/updatepassword'   => ['api/:version.user/updatePassword',['method'=>'post']],
        ':version/adduserincode'   => ['api/:version.user/addUserInCode',['method'=>'post']],
        ':version/getuserinfo/:userId'   => ['api/:version.user/getUserInfo',['method'=>'get']],
        ':version/updateportrait'   => ['api/:version.user/updatePortrait',['method'=>'post']],
        ':version/updateusername'   => ['api/:version.user/updateUserName',['method'=>'post']],
        
        ':version/notification'   => ['api/:version.user/notification',['method'=>'get']],
        ':version/announcement'   => ['api/:version.user/announcement',['method'=>'get']],
        
        //地址
        ':version/address/:userId'   => ['api/:version.address/index',['method'=>'get']],
        ':version/address/add'   => ['api/:version.address/add',['method'=>'post']],
        ':version/address/edit'   => ['api/:version.address/edit',['method'=>'post']],
        ':version/address/del'   => ['api/:version.address/del',['method'=>'post']],
        
        
        //消费
        ':version/chargetype'   => ['api/:version.charge/chargetype',['method'=>'get']], 
        ':version/recharge'   => ['api/:version.charge/recharge',['method'=>'post']], 
        ':version/tixian'   => ['api/:version.charge/tixian',['method'=>'post']], 
        ':version/recordconsume'   => ['api/:version.charge/recordConsume',['method'=>'get']], 
        ':version/recordrecharge'   => ['api/:version.charge/recordRecharge',['method'=>'get']], 
        ':version/recordtixian'   => ['api/:version.charge/recordTixian',['method'=>'get']], 
        
        

        
        //购物车
        ':version/shopcart/:userId'   => ['api/:version.order/shoppingcart',['method'=>'get']],
        ':version/shopcartedit'   => ['api/:version.order/shoppingcartEidt',['method'=>'put']],
        ':version/shopcartadd'   => ['api/:version.order/shoppingcartAdd',['method'=>'post']],
        
        
        //期数
        ':version/haslottery/:userId'   => ['api/:version.period/haslottery',['method'=>'get']],
        ':version/inlottery/:userId'   => ['api/:version.period/inlottery',['method'=>'get']],
        ':version/haswin/:userId'   => ['api/:version.period/haswin',['method'=>'get']],
        
        

    ],
    
    
];