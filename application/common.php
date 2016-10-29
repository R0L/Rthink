<?php
// 应用公共文件
/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end    结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start=1,$end=10,$length=4){
    $connt=0;
    $temp=array();
    while($connt<$length){
        $temp[]=mt_rand($start,$end);
        $data=array_unique($temp);
        $connt=count($data);
    }
    sort($data);
    return $data;
}

/**
 * 将字符串分割为数组    
 * @param  string $str 字符串
 * @return array       分割得到的数组
 */
function mb_str_split($str){
    return preg_split('/(?<!^)(?!$)/u', $str );
}

/**
 * 验证是否是邮箱
 * @param  string  $email 邮箱
 * @return boolean        是否是邮箱
 */
function is_email($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

/**
 * 验证是否是url
 * @param  string  $url   url
 * @return boolean        是否是url
 */
function is_url($url){
    if(filter_var($url,FILTER_VALIDATE_URL)){
        return true;
    }else{
        return false;
    }
}