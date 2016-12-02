<?php

namespace application\common\service;
use application\common\logic\Share as ShareLogic;
use application\common\logic\User as UserLogic;
use application\common\logic\UserInfo as UserInfoLogic;
use application\common\logic\Picture as PictureLogic;
use application\common\logic\Period as PeriodLogic;
use application\common\logic\Goods as GoodsLogic;

use application\common\api\Result;
/**
 * @author ROL
 * @date 2016-11-30 10:40:04
 * @version V1.0
 * @desc   
 */
class Share extends Common {
    /**
     * 晒单
     * @return type
     * 用户头像、用户昵称、晒单标题、晒单内容、晒单图片，晒单时间，商品名称
     */
    public static function listShare() {
        $listShare = ShareLogic::selectByShareStatus();
        
        foreach ($listShare as $item) {
            $userGet = UserLogic::get($item["user_id"]);
            $userInfoGet = UserInfoLogic::get(["user_id"=>$item["user_id"]]);
            $pictureGet = PictureLogic::get($userInfoGet["portrait"]);
            $sharePictureGet = PictureLogic::selectToPathByIds($item["pic_list"]);
            $periodGet = PeriodLogic::get($item["period_id"]);
            $goodsGet = GoodsLogic::get($periodGet["goods_id"]);
            $item->data("user_portrait",$pictureGet["path"]);//用户头像
            $item->data("user_name",$userGet["user_name"]);//用户昵称
            $item->data("share_title",$item["title"]);//晒单标题
            $item->data("share_content",$item["content"]);//晒单内容
            $item->data("share_picture",$sharePictureGet);//晒单图片
            $item->data("share_time",$item["update_time"]);//晒单时间
            $item->data("goods_name",$goodsGet["title"]);//商品名称
            $item->visible(["id","user_portrait","user_name","share_title","share_content","share_picture","share_time","goods_name"]);
        }
        
        return Result::success(1700,$listShare);
    }
    
    /**
     * 添加晒单
     * @param type $userId
     * @param type $periodId
     * @param type $title
     * @param type $content
     * @param type $pictures
     * @return type
     */
    public static function addShare($userId,$periodId,$title,$content,$pictures) {
        
        $existPeriod = PeriodLogic::isExistPeriod($userId, $periodId);
        
        if(empty($existPeriod)){
            return Result::error(1707);
        }
        
        
        $data["user_id"] = $userId;
        $data["period_id"] = $periodId;
        $data["title"] = $title;
        $data["content"] = $content;
        $data["pic_list"] = $pictures;
        $data["share_status"] = ShareLogic::SHARE_INIT;
        $createModel = ShareLogic::create($data);
        if ($createModel->getError()) {
            return Result::error(1702,$createModel->getError());
        }
        return Result::success(1701);
    }
    
    /**
     * 编辑晒单
     * @param type $id
     * @param type $title
     * @param type $content
     * @param type $pictures
     * @return type
     */
    public static function editShare($id,$title = null,$content = null,$pictures = null) {
        empty($title) || $data["title"] = $title;
        empty($content) || $data["content"] = $content;
        empty($pictures) || $data["pic_list"] = $pictures;
        $data["share_status"] = ShareLogic::SHARE_INIT;
        $updateModel = ShareLogic::update($data, ["id"=>$id]);
        if ($updateModel->getError()) {
            return Result::error(1704,$updateModel->getError());
        }
        return Result::success(1703);
    }
    
    
    /**
     * 删除晒单
     * @param type $id
     * @return type
     */
    public static function delShare($id) {
        $delShare = ShareLogic::delById($id, true);
        if (empty($delShare)) {
            return Result::error(1704);
        }
        return Result::success(1705);
    }
}
