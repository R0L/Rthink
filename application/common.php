<?php

// 应用公共文件
/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end    结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start = 1, $end = 10, $length = 4) {
    $connt = 0;
    $temp = array();
    while ($connt < $length) {
        $temp[] = mt_rand($start, $end);
        $data = array_unique($temp);
        $connt = count($data);
    }
    sort($data);
    return $data;
}

/**
 * 将字符串分割为数组    
 * @param  string $str 字符串
 * @return array       分割得到的数组
 */
function mb_str_split($str) {
    return preg_split('/(?<!^)(?!$)/u', $str);
}

/**
 * 验证是否是邮箱
 * @param  string  $email 邮箱
 * @return boolean        是否是邮箱
 */
function is_email($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 验证是否是url
 * @param  string  $url   url
 * @return boolean        是否是url
 */
function is_url($url) {
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 *
 */
function str2arr($str, $glue = ',') {
    return explode($glue, $str);
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 *
 */
function arr2str($arr, $glue = ',') {
    return implode($glue, $arr);
}

/**
 * 设置跳转页面URL
 * 使用函数再次封装，方便以后选择不同的存储方式（目前使用cookie存储）
 *
 */
function set_redirect_url($url) {
    cookie('redirect_url', $url);
}

/**
 * 获取跳转页面URL
 * @return string 跳转页URL
 *
 */
function get_redirect_url() {
    $url = cookie('redirect_url');
    return empty($url) ? __APP__ : $url;
}

/**
 * 后台获取图片展示
 * @param type $cover_id
 * @return type
 */
function get_cover_html($cover_id) {
    if (is_numeric($cover_id)) {
        $cover_id = get_cover($cover_id, "path");
    }
    return "<img class=\"cover\" src=\"" . $cover_id . "\">";
}

/**
 * 获取文档封面图片
 * @param int $cover_id
 * @param string $field
 * @return 完整的数据  或者  指定的$field字段值
 *
 */
function get_cover($cover_id, $field = null) {
    if (empty($cover_id)) {
        return false;
    }
    $picture = db('picture')->where(array('status' => 1))->getById($cover_id);
    return empty($field) ? $picture : $picture[$field];
}

/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 *
 */
function time_format($time = NULL, $format = 'Y-m-d H:i') {
    $time = $time === NULL ? NOW_TIME : intval($time);
    return date($format, $time);
}

/**
 * 小数转汇率
 * @param type $float
 */
function flaot_to_rate($float) {
    $temp_var = (String) $float * 100;
    return $temp_var . "%";
}

/* * *
 * 自定义函数
 */
/* * *
 * 手机/PC端浏览器判断
 */

function ismobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;

    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if (isset($_SERVER['HTTP_CLIENT']) && 'PhoneClient' == $_SERVER['HTTP_CLIENT'])
        return true;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA']))
    //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    //判断手机发送的客户端标志,兼容性有待提高
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile'
        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}

/* * *
 * 生成订单号
 */

function trade_no() {
    list($usec, $sec) = explode(" ", microtime());
    $usec = substr(str_replace('0.', '', $usec), 0, 4);
    $str = rand(1000, 9999);
    return date("YmdHis") . $usec . $str;
}

/* * *
 * 判断数组的深度
 */

function array_depth($a) {
    if (is_array($a)) {
        $max_depth = 0;
        foreach ($a as $key => $value) {
            $depth = array_depth($value);
            if ($depth > $max_depth) {
                $max_depth = $depth;
            }
        }
        return $max_depth + 1;
    }
    return 0;
}

/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key  加密密钥
 * @param int $expire  过期时间 单位 秒
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_encrypt($data, $key = '', $expire = 0) {
    $key = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data = base64_encode($data);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l)
            $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time() : 0);

    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
    }
    return str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($str));
}

function is_login() {
    $user_id = session('user_id');
    if (empty($user_id)) {
        return 0;
    } else {
        return $user_id;
    }
}

/**
 * 
 * @param type $str
 * @param type $key
 * @return type
 */
//function think_md5($str, $key = 'RLthink123456789'){
//	return '' === $str ? '' : md5(sha1($str) . $key);
//}
function think_md5($str){
	return '' === $str ? '' : md5($str);
}