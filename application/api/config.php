<?php
return [
    'url_route_on'=>  true,
//    'url_route_must'=>  true,
//    'url_domain_deploy' =>  true,
//    'url_domain_deploy' =>  true,
//    'url_domain_root'    =>  'tp.jh',
    'default_return_type'=>'json',
    
    'code'=>[
        
        '0'=>'操作成功',
        '100'=>'操作失败，客户端异常',
        //检查数据
        '1101'=>'缺少手机号码',
        '1102'=>'手机号码不符合规则',
        '1103'=>'缺少验证码',
        '1104'=>'验证码不符合规则，只含有4位数字',
        '1105'=>'缺少用户Id',
        '11051'=>'不存在该用户Id',
        '1106'=>'缺少用户密码',
        '1107'=>'用户密码不符合规则，超出限制范围',
        '1108'=>'缺少用户昵称',
        '1109'=>'用户昵称不符合规则，超出限制范围',
        '1111'=>'参数类型不正确：只能为数组',
        '1113'=>'缺少订单Id',
        '1114'=>'不存在该订单Id',
        //用户相关
        '1201'=>'短信验证码初始化失败',
        '1202'=>'短信验证码达到今日发送上线',
        '1203'=>'短信验证码发送失败',
        '1204'=>'短信验证码发送成功',
        '1205'=>'该用户还没有发送短信',
        '1206'=>'短信验证码状态更新失败',
        '1207'=>'短信验证码匹配不成功',
        '1208'=>'短信验证成功',
        '1209'=>'修改密码失败，请重试:',
        '1230'=>'修改密码成功',
        '1231'=>'用户账户插入失败',
        '1232'=>'用户信息插入失败',
        '1240'=>'添加用户成功',
        '1241'=>'用户已经存在',
        '1242'=>'用户资料获取失败：',
        '1243'=>'用户资料获取成功',
        '1244'=>'图片上传失败',
        '1245'=>'修改用户头像失败：',
        '1246'=>'修改用户头像成功',
        '1247'=>'修改用户昵称失败：',
        '1248'=>'修改用户昵称成功',
        
        
        '1250'=>'通知列表获取成功',
        '1251'=>'公告列表获取成功',
        '1252'=>'轮播列表获取成功',
        
        //订单
        '1330'=>'订单购物车获取成功',
        '1340'=>'购物车操作成功',
        '1341'=>'购物车编辑失败：',
        '1342'=>'购物车删除失败：',
        '1343'=>'购物车添加失败：订单数据插入失败',
        '1344'=>'购物车添加成功',
        '1345'=>'购物车添加失败：添加期数失败',
        
        //期数
        '1300'=>'订单已揭晓获取成功',
        '1310'=>'订单已中奖获取成功',
        '1320'=>'订单进行中获取成功',
        '1330'=>'热门期数获取成功',
        '1340'=>'最新期数获取成功',
        
        //地址
        '1400'=>'个人地址获取成功',
        '1401'=>'个人地址添加成功',
        '1402'=>'个人地址添加失败',
        '1403'=>'个人地址编辑成功',
        '1404'=>'个人地址编辑失败',
        '1405'=>'个人地址删除成功',
        '1406'=>'个人地址删除失败',
        
        
        //充值
        '1600'=>'充值类型获取成功',
        '1610'=>'消费记录获取成功',
        '1620'=>'充值记录获取成功',
        '1630'=>'提现记录获取成功',
        '1631'=>'提现操作失败',
        '1632'=>'提现操作成功',
        '1633'=>'充值初始化操作失败',
        '1634'=>'充值初始化操作成功',
        
        
        
        
        
        '200'=>'操作失败，服务器异常',
        
    ]
    
];
