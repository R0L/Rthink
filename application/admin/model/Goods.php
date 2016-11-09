<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-8 14:58:12
 * @version V1.0
 * @desc   
 */
class Goods extends Base {

    
    //自动完成
    /**
     * status 信息状态
     * goods_status 商品状态
     * count_down 倒计时世间
     * type 人次单价
     * @var type 
     */
    protected $insert = ['status' => 1, 'goods_status' => -1, 'count_down' => 300000,'type'=>1];

    /**
     * 获取商品状态
     * @param type $status
     * @param type $data
     * @return string
     */
    public function getGoodsStatusTextAttr($status, $data) {
        if (empty($status)) {
            $status = $data["status"];
        }
        $op_status = [-2 => '审核失败', -1 => '未审核/未上架', 0 => '已审核/未上架', 1 => '已上架/夺宝中', 2 => '已下架', 3 => '夺宝结束', 4 => '重新开始'];
        return $op_status[intval($status)];
    }
    
    /**
     * 计算总参与次数
     * @param type $value
     * @param type $data
     * @return type
     */
    public function setTotalTimeAttr($value,$data){
        if(empty($value)){
            return ceil(doubleval($data["price"])/intval($data["type"]));
        }
        return $value;
    }
    
    /**
     * 商品的栏目
     * @return type
     */
    public function category(){
        return $this->belongsTo('Category',"category_id","id");
    }
    
    /**
     * 商品的品牌
     * @return type
     */
    public function brand(){
        return $this->belongsTo('Brand',"brand_id","id");
    }
}
