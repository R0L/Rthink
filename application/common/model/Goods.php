<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-8 14:58:12
 * @version V1.0
 * @desc   
 */
class Goods extends Base {
    
    
    const GOODS_FAILURE = -2; //审核失败
    const GOODS_NOCHECKED = -1; //待审核
    const GOODS_CHECKED = 0; //已审核/待上线
    const GOODS_ONLINE = 1; //已上线/夺宝中
    const GOODS_SHELF = 2; //已下架
    const GOODS_COMPLETE = 3; //已结束


    public static $goodsStstus=[-2 => '审核失败', -1 => '待审核', 0 => '已审核/待上线', 1 => '已上线/夺宝中', 2 => '已下架', 3 => '已结束'];
    

    //自动完成
    /**
     * status 信息状态
     * goods_status 商品状态
     * count_down 倒计时世间
     * type 人次单价
     * @var type 
     */
    protected $insert = ['status' => 1, 'create_time', 'pub_id', 'member_id', 'goods_status' => -1,'total_time', 'count_down', 'type' => 1,'cover_id','cover_list'];

    /**
     * 获取商品状态
     * @param type $status
     * @param type $data
     * @return string
     */
    public function getGoodsStatusTextAttr($status, $data) {
        if (empty($status)) {
            $status = $data["goods_status"];
        }
        return self::$goodsStstus[intval($status)];
    }

    /**
     * 计算总参与次数
     * @param type $value
     * @param type $data
     * @return type
     */
    public function setTotalTimeAttr($value, $data) {
        if (empty($value)) {
            return ceil(doubleval($data["price"]) / intval($data["type"]));
        }
        return $value;
    }
    /**
     * 计算即将开奖的时间
     * @param type $value
     * @param type $data
     * @return type
     */
    public function setCountDownAttr($value) {
        if (empty($value)) {
            return 300000;
        }
        return $value;
    }
    
    /**
     * 图片数组到对象的转换
     * @return type
     */
    protected function setCoverIdAttr($cover_id,$data){
        if(empty($cover_id)){
            $cover_id =  $data["cover_id[]"];
        }
        return implode(",", $cover_id);
    }
    /**
     * 图片数组到对象的转换
     * @return type
     */
    protected function setCoverListAttr($cover_list,$data){
        if(empty($cover_list)){
            $cover_list =  $data["cover_list[]"];
        }
        return implode(",", $cover_list);
    }
    

    /**
     * 商品的栏目
     * @return type
     */
    public function category() {
        return $this->belongsTo('Category', "category_id", "id");
    }

    /**
     * 商品的品牌
     * @return type
     */
    public function brand() {
        return $this->belongsTo('Brand', "brand_id", "id");
    }

}
