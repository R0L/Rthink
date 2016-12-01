<?php

namespace application\api\controller\v1;

use application\api\controller\Api;
use application\common\controller\Attach;
use think\Request;

/**
 * @author ROL
 * @date 2016-11-30 11:22:50
 * @version V1.0
 * @desc   
 */
class Tools extends Api {

    /**
     * 上传图片 接口
     * @param Request $request
     * @return int
     */
    public function uploadPicture(Request $request) {
        $Attach = new Attach();
        try {
            $upload = $Attach->uploadPicture($request);
        } catch (Exception $exc) {
            return parent::jCode(1244, $exc);
        }
        return parent::jCode(0, 1249, $upload);
    }

    /**
     * 服务器 时间 接口
     * @return type
     */
    public function getCurrentTime() {
        return parent::jCode(0, 1253, time());
    }

    /**
     * 获取最新的彩票
     * @return type
     */
    public function lottery() {
        $ch = curl_init();
        $url = 'http://apis.baidu.com/apistore/lottery/lotteryquery?lotterycode=ssq&recordcnt=1';
        $header = array(
            'apikey: baaa384bf64d518283e7efc87ccd29a1',
        );
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);

        $lottery = json_decode($res);
        
        if(empty($lottery->errNum)){
            $temp = $lottery->retData->data[0]->openCode;
            $result = array_sum(explode(",", str_replace("+",",",$temp)));
//            Cache::set($lottery->retData->data[0]->openTimeStamp, $result);
        }else{
            $result = "0000";
        }
        return ["data"=>$temp,"fromat_data"=>$result];
    }
    
    
    
}
