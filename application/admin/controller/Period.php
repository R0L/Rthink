<?php
namespace application\admin\controller;
use application\admin\service\Period as PeriodService;

/**
 * @author ROL
 * @date 2016-11-10 12:41:08
 * @version V1.0
 * @desc   
 */
class Period extends Admin {
    
    public function index() {
        $map = array();
        $map["status"] = 1;
        $title = trim(input('title'));
        if(!empty($title)){
            $map["title"] = ["like", "%" . $title . "%"];
        }
        $periods_status = trim(input('periods_status'));
        if(!empty($periods_status)){
            $map["periods_status"] = $periods_status;
        }
        $Period = new PeriodService();
        $lists = $Period->where($map)->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
}
