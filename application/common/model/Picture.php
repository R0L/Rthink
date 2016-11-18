<?php

namespace application\common\model;

use \think\Model;

/**
 * CREATE TABLE `NewTable` (
 *  `id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id自增' ,
 *  `path`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '路径' ,
 *  `url`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片链接' ,
 *  `md5`  char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件md5' ,
 *  `sha1`  char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件 sha1编码' ,
 *  `status`  tinyint(2) NOT NULL DEFAULT 0 COMMENT '状态' ,
 *  `create_time`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间' ,
 *  `update_time`  int(10) NOT NULL ,
 *  PRIMARY KEY (`id`)
 *  )
 */

/**
 * 图片模型
 */
class Picture extends Model {

    protected $autoWriteTimestamp = true;
    protected $format = 'Y-m-d H:i';
    //自动完成
    protected $auto = ['update_time'];
    protected $insert = ['status' => 1, 'create_time'];
    protected $update = [];

    /**
     * 创建时间自动完成
     * @return type
     */
    protected function setCreateTimeAttr() {
        return time();
    }

    /**
     * 更新时间自动完成
     * @return type
     */
    protected function setUpdateTimeAttr() {
        return time();
    }

    /**
     * 信息的状态
     * @param type $status
     * @param type $data
     * @return string
     */
    public function getStatusTextAttr($status, $data) {
        if (empty($status)) {
            $status = $data["status"];
        }
        $op_status = [-1 => '删除', 0 => '禁用', 1 => '正常'];
        return $op_status[intval($status)];
    }

    /**
     * 获取创建时间格式化
     * @param type $create_time
     * @return type
     */
    public function getCreateTimeFromatAttr($create_time, $data) {
        if (empty($create_time)) {
            $create_time = $data["create_time"];
        }
        $time = $create_time === NULL ? time() : intval($create_time);
        return date($this->format, $time);
    }

    /**
     * 获取更新时间格式化
     * @param type $update_time
     * @return type
     */
    public function getUpdateTimeFromatAttr($update_time, $data) {
        if (empty($update_time)) {
            $update_time = $data["update_time"];
        }
        $time = $update_time === NULL ? time() : intval($update_time);
        return date($this->format, $time);
    }

    // 定义全局的查询范围
    protected function base($query) {
        $query->where(["status" => 1]);
    }
    
    
    /**
     * 添加图片
     * @param type $data
     * @return boolean
     */
    public static function add($data) {
        $create = parent::create($data);
        if(empty($create)){
            return false;
        }
        return $create->id;
    }
    
    /**
     * 判断图片是否存在
     * @param type $picture md5,sha1
     * @return boolean
     * @throws Exception
     */
    public static function isExists($picture) {
        if (empty($picture['md5'])) {
            throw new Exception("缺少参数");
        }
        $map = array('md5' => $picture['md5'], 'sha1' => $picture['sha1'],);
        if ($picture = parent::get($map)) {
            return $picture->id;
        } else {
            return false;
        }
    }

}
