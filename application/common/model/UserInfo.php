<?php
namespace application\common\model;
use think\Model;
/**
 * @author ROL
 * @date 2016-11-10 11:07:35
 * @version V1.0
 * @desc   
 */
class UserInfo extends Model {
    
    /**
     * 自动完成
     * 积分 0.00;账户余额 0.00;红包 0.00;
     * @var type 
     */
    protected $insert = ["score"=>0,"amount"=>0.00,"red_packets"=>0.00];  
    
    
    
    
    
}
