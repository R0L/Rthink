<?php
namespace application\admin\controller;
use application\admin\service\Order as OrderService;

/**
 * @author ROL
 * @date 2016-11-10 12:41:08
 * @version V1.0
 * @desc   
 */
class Order extends Admin {
    
    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if(!empty($title)){
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $Order = new OrderService();
        $lists = $Order->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
}
