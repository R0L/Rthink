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
        ':version/password'   => ['api/:version.user/updatePassword',['method'=>'post']],
        ':version/register'   => ['api/:version.user/addUserInCode',['method'=>'post']],
        ':version/userinfo/:userId'   => ['api/:version.user/getUserInfo',['method'=>'get']],
        ':version/portrait'   => ['api/:version.user/updatePortrait',['method'=>'post']],
        ':version/nickname'   => ['api/:version.user/updateNickName',['method'=>'post']],
        
        ':version/notif/:userId'   => ['api/:version.user/notification',['method'=>'get']],
        ':version/updatenotif'   => ['api/:version.user/updateNotification',['method'=>'post']],
        ':version/annou/:userId'   => ['api/:version.user/announcement',['method'=>'get']],
        ':version/slider'   => ['api/:version.user/listSlider',['method'=>'get']],
        ':version/login'   => ['api/:version.user/userLogin',['method'=>'post']],
        
        //地址
        ':version/address/:userId'   => ['api/:version.address/index',['method'=>'get']],
        ':version/address/add'   => ['api/:version.address/add',['method'=>'post']],
        ':version/address/edit'   => ['api/:version.address/edit',['method'=>'post']],
        ':version/address/del'   => ['api/:version.address/del',['method'=>'post']],
        
        ':version/address/list'   => ['api/:version.address/amap',['method'=>'post']],
        
        
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
        
        ':version/hotperiod'   => ['api/:version.period/hotPeriod',['method'=>'get']],
        ':version/newestperiod'   => ['api/:version.period/newestPeriod',['method'=>'get']],
        ':version/progressperiod'   => ['api/:version.period/progressPeriod',['method'=>'get']],
        ':version/mantimeperiod'   => ['api/:version.period/mantimePeriod',['method'=>'get']],
        ':version/soonperiod'   => ['api/:version.period/soonPeriod',['method'=>'get']],
        
        
         //晒单
        ':version/share'   => ['api/:version.share/index',['method'=>'get']],
        ':version/share/add'   => ['api/:version.share/add',['method'=>'post']],
        ':version/share/edit'   => ['api/:version.share/edit',['method'=>'post']],
        ':version/share/del'   => ['api/:version.share/del',['method'=>'post']],
        
        
        
        //Tools 
        ':version/upload'   => ['api/:version.tools/uploadPicture',['method'=>'post']],
        ':version/time'   => ['api/:version.tools/getCurrentTime',['method'=>'get']],
        ':version/lottery'   => ['api/:version.tools/lottery',['method'=>'get']],
        

    ],
    
    
];