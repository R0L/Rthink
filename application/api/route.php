<?php

use think\Route;
Route::domain('api','api');
Route::group(':version', function(){
    Route::rule(':user/sendSms/:mobile','api/:version.:user/sendSms');
});



//\Think\Route::any('api/:version/user/sendSms/:mobile','api/v1.user/sendSms');
 
return [

//    'api/'=>'api/Aa/bb',
//    'api/:version/user/sendSms/:mobile' => 'api/:version.user/sendSms',
    
];