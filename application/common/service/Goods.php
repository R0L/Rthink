<?php
namespace application\common\service;
use application\common\logic\Goods as GoodsLogic;
use application\common\logic\Picture as PictureLogic;
use application\common\logic\Period as PeriodLogic;
use application\common\logic\Order as OrderLogic;
use application\common\api\Result;
/**
 * @author ROL
 * @date 2016-11-11 11:43:07
 * @version V1.0
 * @desc   
 */
class Goods {
    
    
    
    /**
     * 商品详情
     * @param type $goodsId
     * @return type
     */
    public static function goodsDetails($goodsId) {
        $goods = GoodsLogic::getByGoodsId($goodsId);
        
        if(empty($goods)){
            return Result::error(1118);
        }
        
        $currentPeriod = PeriodLogic::getCurrentPeriodByGoodsId($goodsId);
        
        if(empty($currentPeriod)){
            return Result::error(1119);
        }
        
        $result = [];
        
        $result["goods_picture"] = PictureLogic::selectToPathByIds($goods["cover_list"]);
        $result["goods_name"] = $goods["title"];
        $result["total_time"] = $goods["total_time"];
        $result["buy_time"] = $currentPeriod["buy_time"];
        $result["periods_no"] = $currentPeriod["periods_no"];
        
        return Result::success(1900,$result);
    }
    
    
    
    /**
     * 商品图文
     * @param type $goodsId
     */
    public static function goodsImageText($goodsId) {
        $goods = GoodsLogic::getByGoodsId($goodsId);
        
        if(empty($goods)){
            return Result::error(1118);
        }
        
        $goods->visible(["content"]);
        
        return Result::error(1910,$goods);
        
    }
    
    
    
    /**
     * 历史中奖记录
     * @param type $goodsId
     */
    public static function historyLottery($goodsId) {
        $periodByGoodsId = PeriodLogic::paginatePeriodByGoodsId($goodsId, PeriodLogic::PERIODS_HASLOTTERY);
        foreach ($periodByGoodsId as $item) {
            $orderGet = OrderLogic::get($item["id"]);
            $item->data("period_id",$item["id"]);//期号
            $item->data("user_picture",PictureLogic::getPathById($item->userinfo["portrait"]));//用户头像
            $item->data("nick_name",$item->userinfo["nick_name"]);//用户昵称
            $item->data("user_ip",$item->user["last_login_ip"]);//用户ip
            $item->data("join_time",$orderGet["create_time"]);//购买时间
            $item->data("lucky_number",$item["lucky_number"]);//幸运号码
            $item->visible(["period_id","user_picture","nick_name","user_ip","join_time","lucky_number"]);
        }
        return Result::success(1920,$periodByGoodsId);
    }
    
    
}
