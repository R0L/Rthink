<?php

namespace application\common\api;

/**
 * @author ROL
 * @date 2016-12-1 12:40:36
 * @version V1.0
 * @desc   
 */
class Result {

    private $status = true;
    private $code = 0;
    private $message = "操作成功";
    private $data = null;

    function getStatus() {
        return $this->status;
    }

    function getCode() {
        return $this->code;
    }

    function getMessage() {
        return $this->message;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setMessage($message) {
        $this->message = $message;
    }
    
    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

    
    function __construct($status, $code, $message,$data) {
        $this->status = $status;
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }
    
    public static function error($code,$message ="",$data =null) {
        return new self(false,$code,$message,$data);
    }
    public static function success($code=null,$data =null) {
        return new self(true,$code,null,$data);
    }

    public function isSuccess() {
        return $this->status;
    }
    public function isError() {
        return $this->status?false:true;
    }
}
