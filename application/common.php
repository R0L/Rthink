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
 * 记录行为日志，并执行该行为的规则
 * @param string $action 行为标识
 * @param string $model 触发行为的模型名
 * @param int $record_id 触发行为的记录id
 * @param int $user_id 执行行为的用户id
 * @return boolean
 */
function action_log($action = null, $model = null, $record_id = null, $user_id = null) {
    //参数检查
    if (empty($action) || empty($model) || empty($record_id)) {
        return '参数不能为空';
    }
    if (empty($user_id)) {
        $user_id = is_login();
    }

    //查询行为,判断是否执行
    $action_info = \think\Db::name('Action')->where(["name" => $action]);
    if ($action_info['status'] != 1) {
        return '该行为被禁用或删除';
    }
    $now_time = time();
    $request = \think\Request::instance();
    //插入行为日志
    $data['action_id'] = $action_info['id'];
    $data['user_id'] = $user_id;
    $data['action_ip'] = $request->ip();
    $data['model'] = $model;
    $data['record_id'] = $record_id;
    $data['create_time'] = $now_time;

    //解析日志规则,生成日志备注
    if (!empty($action_info['log'])) {
        if (preg_match_all('/\[(\S+?)\]/', $action_info['log'], $match)) {
            $log['user'] = $user_id;
            $log['record'] = $record_id;
            $log['model'] = $model;
            $log['time'] = $now_time;
            $log['data'] = array('user' => $user_id, 'model' => $model, 'record' => $record_id, 'time' => $now_time);
            foreach ($match[1] as $value) {
                $param = explode('|', $value);
                if (isset($param[1])) {
                    $replace[] = call_user_func($param[1], $log[$param[0]]);
                } else {
                    $replace[] = $log[$param[0]];
                }
            }
            $data['remark'] = str_replace($match[0], $replace, $action_info['log']);
        } else {
            $data['remark'] = $action_info['log'];
        }
    } else {
        //未定义日志规则，记录操作url
        $data['remark'] = '操作url：' . $request->url();
    }

    \think\Db::name('ActionLog')->insert($data);

    if (!empty($action_info['rule'])) {
        //解析行为
        $rules = parse_action($action, $user_id);

        //执行行为
        $res = execute_action($rules, $action_info['id'], $user_id);
    }
}

/**
 * 解析行为规则
 * 规则定义  table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
 * 规则字段解释：table->要操作的数据表，不需要加表前缀；
 *              field->要操作的字段；
 *              condition->操作的条件，目前支持字符串，默认变量{$self}为执行行为的用户
 *              rule->对字段进行的具体操作，目前支持四则混合运算，如：1+score*2/2-3
 *              cycle->执行周期，单位（小时），表示$cycle小时内最多执行$max次
 *              max->单个周期内的最大执行次数（$cycle和$max必须同时定义，否则无效）
 * 单个行为后可加 ； 连接其他规则
 * @param string $action 行为id或者name
 * @param int $self 替换规则里的变量为执行用户的id
 * @return boolean|array: false解析出错 ， 成功返回规则数组
 */
function parse_action($action, $self) {
    if (empty($action)) {
        return false;
    }

    //参数支持id或者name
    if (is_numeric($action)) {
        $map = array('id' => $action);
    } else {
        $map = array('name' => $action);
    }

    //查询行为信息
    $info = \think\Db::name('Action')->where($map)->find();
    if (!$info || $info['status'] != 1) {
        return false;
    }

    //解析规则:table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
    $rules = $info['rule'];
    $rules = str_replace('{$self}', $self, $rules);
    $rules = explode(';', $rules);
    $return = array();
    foreach ($rules as $key => &$rule) {
        if (empty($rule))
            continue;
        $rule = explode('|', $rule);
        foreach ($rule as $k => $fields) {
            $field = empty($fields) ? array() : explode(':', $fields);
            if (!empty($field)) {
                $return[$key][$field[0]] = $field[1];
            }
        }
        //cycle(检查周期)和max(周期内最大执行次数)必须同时存在，否则去掉这两个条件
        if (!array_key_exists('cycle', $return[$key]) || !array_key_exists('max', $return[$key])) {
            unset($return[$key]['cycle'], $return[$key]['max']);
        }
    }

    return $return;
}

/**
 * 执行行为
 * @param array $rules 解析后的规则数组
 * @param int $action_id 行为id
 * @param array $user_id 执行的用户id
 * @return boolean false 失败 ， true 成功
 */
function execute_action($rules = false, $action_id = null, $user_id = null) {
    if (!$rules || empty($action_id) || empty($user_id)) {
        return false;
    }

    $return = true;
    foreach ($rules as $rule) {

        //检查执行周期
        $map = array('action_id' => $action_id, 'user_id' => $user_id);
        $map['create_time'] = array('gt', time() - intval($rule['cycle']) * 3600);
        $exec_count = \think\Db::name('ActionLog')->where($map)->count();
        if ($exec_count > $rule['max']) {
            continue;
        }

        //执行数据库操作
        $Model = \think\Db::name(ucfirst($rule['table']));
        $field = $rule['field'];
        $res = $Model->where($rule['condition'])->setField($field, array('exp', $rule['rule']));

        if (!$res) {
            $return = false;
        }
    }
    return $return;
}

/**
 * 上传文件类型控制 此方法仅限ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 52428800
 * @return booler   返回ajax的json格式数据
 */
function ajax_upload($path = 'file', $format = 'empty', $maxSize = '52428800') {
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path = trim($path, '/');
    // 添加Upload根目录
    $path = strtolower(substr($path, 0, 6)) === 'upload' ? ucfirst($path) : 'Upload/' . $path;
    // 上传文件类型控制
    $ext_arr = array(
        'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
        'photo' => array('jpg', 'jpeg', 'png'),
        'flash' => array('swf', 'flv'),
        'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
        'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2', 'pdf')
    );
    if (!empty($_FILES)) {
        // 上传文件配置
        $config = array(
            'maxSize' => $maxSize, // 上传文件最大为50M
            'rootPath' => './', // 文件上传保存的根路径
            'savePath' => './' . $path . '/', // 文件上传的保存路径（相对于根路径）
            'saveName' => array('uniqid', ''), // 上传文件的保存规则，支持数组和字符串方式定义
            'autoSub' => true, // 自动使用子目录保存上传文件 默认为true
            'exts' => isset($ext_arr[$format]) ? $ext_arr[$format] : '',
        );
        // 实例化上传
        $upload = new \Think\Upload($config);
        // 调用上传方法
        $info = $upload->upload();
        $data = array();
        if (!$info) {
            // 返回错误信息
            $error = $upload->getError();
            $data['error_info'] = $error;
            echo json_encode($data);
        } else {
            // 返回成功信息
            foreach ($info as $file) {
                $data['name'] = trim($file['savepath'] . $file['savename'], '.');
                echo json_encode($data);
            }
        }
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