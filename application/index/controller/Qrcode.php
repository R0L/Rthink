<?php

namespace application\index\controller;

use Endroid\QrCode\QrCode as toolQrCode;

class Qrcode {

    public function view() {
        //生成当前的二维码
        $qrCode = new toolQrCode();
        //想显示在二维码中的文字内容，这里设置了一个查看文章的地址
        $url = url('https://www.baidu.com/',null, true, true);
        $qrCode->setText($url)
                ->setSize(300)
                ->setPadding(10)
                ->setErrorCorrection('high')
                ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
                ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
                ->setLabel('thinkphp.cn')
                ->setLabelFontSize(16)
                ->setImageType(toolQrCode::IMAGE_TYPE_PNG);
        // now we can directly output the qrcode
        header('Content-Type: ' . $qrCode->getContentType());
        $qrCode->render();

//            // or create a response object
//            $response = new Response($qrCode->get(), 200, array('Content-Type' => $qrCode->getContentType()));
    }

}
