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
        ':version/address'   => ['api/:version.address/add',['method'=>'post']],
        ':version/address/:addresId'   => ['api/:version.address/edit',['method'=>'put']],
        ':version/address/:addresId'   => ['api/:version.address/del',['method'=>'delete']],
        
        ':version/address/list'   => ['api/:version.address/amap',['method'=>'post']],
        
        
        //消费
        ':version/chargetype'   => ['api/:version.charge/getChargeType',['method'=>'get']], 
        ':version/recharge'   => ['api/:version.charge/recharge',['method'=>'post']], 
        ':version/tixian'   => ['api/:version.charge/tixian',['method'=>'post']], 
        ':version/consume/:userId'   => ['api/:version.charge/recordConsume',['method'=>'get']], 
        ':version/recharge/:userId'   => ['api/:version.charge/recordRecharge',['method'=>'get']], 
        ':version/tixian/:userId'   => ['api/:version.charge/recordTixian',['method'=>'get']], 
        
        
        //订单
        ':version/haslottery/:userId'   => ['api/:version.order/haslottery',['method'=>'get']],
        ':version/inlottery/:userId'   => ['api/:version.order/inlottery',['method'=>'get']],
        ':version/haswin/:userId'   => ['api/:version.order/haswin',['method'=>'get']],
        ':version/addOrder'   => ['api/:version.order/addOrder',['method'=>'post']],
        
        //购物车
        ':version/shopcart/:userId'   => ['api/:version.shoppingcart/index',['method'=>'get']],
        ':version/shopcart/:orderId'   => ['api/:version.shoppingcart/edit',['method'=>'put']],
        ':version/shopcart'   => ['api/:version.shoppingcart/add',['method'=>'post']],

        
        
        //期数
        
        ':version/hotperiod'   => ['api/:version.period/hotPeriod',['method'=>'get']],
        ':version/newestperiod'   => ['api/:version.period/newestPeriod',['method'=>'get']],
        ':version/progressperiod'   => ['api/:version.period/progressPeriod',['method'=>'get']],
        ':version/mantimeperiod'   => ['api/:version.period/mantimePeriod',['method'=>'get']],
        ':version/soonperiod'   => ['api/:version.period/soonPeriod',['method'=>'get']],
        ':version/currentperson/:periodId'   => ['api/:version.period/currentPeriodPerson',['method'=>'get']],
        
        
         //晒单
        ':version/share'   => ['api/:version.share/index',['method'=>'get']],
        ':version/share'   => ['api/:version.share/add',['method'=>'post']],
        ':version/share/:shareId'   => ['api/:version.share/edit',['method'=>'post']],
        ':version/share/:shareId'   => ['api/:version.share/del',['method'=>'delete']],
        
        
        //商品
        ':version/goodsdetails/:goodsId'   => ['api/:version.goods/goodsDetails',['method'=>'get']],
        ':version/goodsimagetext/:goodsId'   => ['api/:version.goods/goodsImageText',['method'=>'get']],
        ':version/historylottery/:goodsId'   => ['api/:version.goods/historyLottery',['method'=>'get']],
        
        
        //Tools 
        ':version/upload'   => ['api/:version.tools/uploadPicture',['method'=>'post']],
        ':version/time'   => ['api/:version.tools/getCurrentTime',['method'=>'get']],
        ':version/lottery'   => ['api/:version.tools/lottery',['method'=>'get']],
        

    ],
    
    
];