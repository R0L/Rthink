<?php

/**
 * 导入excel文件
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
function import_excel($file) {
    // 判断文件是什么格式
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);
    $type = $type === 'csv' ? $type : 'Excel5';
    ini_set('max_execution_time', '0');
    \think\Loader::import('PHPExcel.PHPExcel', VENDOR_PATH, EXT);
    // 判断使用哪种格式
    $objReader = \PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数 
    $highestRow = $sheet->getHighestRow();
    // 取得总列数      
    $highestColumn = $sheet->getHighestColumn();
    //循环读取excel文件,读取一条,插入一条
    $data = array();
    //从第一行开始读取数据
    for ($j = 1; $j <= $highestRow; $j++) {
        //从A列读取数据
        for ($k = 'A'; $k <= $highestColumn; $k++) {
            // 读取单元格
            $data[$j][] = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
        }
    }
    return $data;
}

/**
 * 数组转xls格式的excel文件
 * @param  array  $data      需要生成excel文件的数组
 * @param  string $filename  生成的excel文件名
 *      示例数据：
  $data = array(
  array(NULL, 2010, 2011, 2012),
  array('Q1',   12,   15,   21),
  array('Q2',   56,   73,   86),
  array('Q3',   52,   61,   69),
  array('Q4',   30,   32,    0),
  );
 */
function create_xls($data, $filename = 'simple.xls') {
    ini_set('max_execution_time', '0');
    \think\Loader::import('PHPExcel.PHPExcel', VENDOR_PATH, EXT);
    $filename = str_replace('.xls', '', $filename) . '.xls';
    $phpexcel = new \PHPExcel();
    $phpexcel->getProperties()
            ->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0
    $objwriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}

/**
 * 邮件发送函数
 */
function send_mail($to, $title, $content) {
    $mail = new PHPMailer();
    $mail->IsSMTP(); // 启用SMTP
//    $mail->SMTPDebug = 2; //显示具体的问题
    $mail->Host = think\Config::get("mail.host");
    $mail->Mailer = think\Config::get("mail.mailer");
    $mail->SMTPAuth = think\Config::get("mail.smtpauth");
    $mail->SMTPSecure = think\Config::get("mail.smtpsecure");
    $mail->Port = think\Config::get("mail.port");
    $mail->Username = think\Config::get("mail.username");
    $mail->Password = think\Config::get("mail.password");
    $mail->From = think\Config::get("mail.from");
    $mail->FromName = think\Config::get("mail.fromname");
    $mail->AddAddress($to, "尊敬的客户");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(think\Config::get("mail.ishtml"));
    $mail->CharSet = think\Config::get("mail.charset");
    $mail->Subject = $title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());
}

// 分析枚举类型配置值 格式 a:名称1,b:名称2
function parse_config_attr($string) {
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if (strpos($string, ':')) {
        $value = array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k] = $v;
        }
    } else {
        $value = $array;
    }
    return $value;
}
