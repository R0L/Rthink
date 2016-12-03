<?php

namespace application\api\controller\v1;
use application\api\controller\GoodsAbstract;
use application\common\service\Goods as GoodsService;

/**
 * @author ROL
 * @date 2016-12-3 13:05:44
 * @version V1.0
 * @desc   
 */
class Goods extends GoodsAbstract {

    /**
     * 商品详情接口
     * @param type $goodsId
     */
    public function goodsDetails($goodsId) {
        $goodsDetails = GoodsService::goodsDetails($goodsId);
        return parent::jResult($goodsDetails);
    }

    /**
     * 商品图文接口
     * @param type $goodsId
     */
    public function goodsImageText($goodsId) {
        $goodsImageText = GoodsService::goodsImageText($goodsId);
        return parent::jResult($goodsImageText);
    }

    /**
     * 历史中奖记录接口
     * @param type $goodsId
     */
    public function historyLottery($goodsId) {
        $historyLottery = GoodsService::historyLottery($goodsId);
        return parent::jResult($historyLottery);
    }

}
