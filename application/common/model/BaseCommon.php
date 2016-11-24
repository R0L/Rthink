<?php

namespace application\common\model;

use think\Session;
use traits\model\SoftDelete;

/**
 * @author ROL
 * @date 2016-10-29 10:21:11
 * @version V1.0
 * @desc   
 */
class BaseCommon extends Base {

    use SoftDelete;
    protected $deleteTime = 'delete_time';
    
    protected $user_id = 0;
    protected $pub_id = 0;

    //初始化
    protected function initialize() {
        parent::initialize();
        $this->user_id = Session::get("user_id");
        if (!in_array($this->user_id, [1])) {
            $this->pub_id = $this->user_id;
        }
    }

    //自动完成
    protected $insert = ['create_time', 'pub_id', 'member_id'];

    /**
     * 所属平台自动完成
     * @param type $pub_id
     * @param type $data
     * @return type
     */
    protected function setPubIdAttr($pub_id, $data) {
        if (empty($pub_id)) {
            $pub_id = $this->pub_id;
        }
        return $pub_id;
    }

    /**
     * 所属用户自动完成
     * @return type
     */
    protected function setMemberIdAttr($member_id, $data) {
        if (empty($member_id)) {
            $member_id = $this->user_id;
        }
        return $member_id;
    }

    // 定义全局的查询范围
    protected function base($query) {
        parent::base($query);
        $map['member_id'] = $this->user_id;
        empty($this->pub_id) || $map['pub_id'] = $this->pub_id;
        $query->where($map);
    }
    
    
    /**
     * 根据id删除
     * @param type $map
     * @return type
     */
    public static function del($map = NULL,$force = false) {
        return self::destroy($map, $force);
    }

    /**
     * 根据id删除
     * @param type $id
     * @return type
     */
    public static function delById($id,$force = false) {
        return self::del(["id"=>$id], $force);
    }
    /**
     * 根据ids删除
     * @param type $ids
     * @return type
     */
    public static function delByIds($ids = [],$force = false) {
        return self::del(["id"=>["in", $ids]],$force);
    }

}
