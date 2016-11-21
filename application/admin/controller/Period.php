<?php
namespace application\admin\controller;
use application\common\logic\Period as PeriodLogic;
use think\Request;
/**
 * @author ROL
 * @date 2016-11-10 12:41:08
 * @version V1.0
 * @desc   
 */
class Period extends Admin {
    
    /**
     * 期数列表总操作
     * @param Request $request
     * @param type $periods_status
     * @return type
     */
    public function index(Request $request,$periods_status) {
        $map = [];
        if($title = $request->param("title")){
            $map["periods_name"] = ["like", "%" . $title . "%"];
        }
        if(empty($periods_status)){
            $periods_status = $request->param("periods_status",  PeriodLogic::PERIODS_INLOTTERY);
        }
        $map["periods_status"] = $periods_status;
        $lists = PeriodLogic::paginate($map);
        $this->assign('lists', $lists);
        $this->assign('periods_status', $periods_status);
        return $this->fetch("index");
    }
    
    
    /**
     * 期数 开奖中
     * @param Request $request
     * @return type
     */
    public function inlottery(Request $request) {
        return $this->index($request, PeriodLogic::PERIODS_INLOTTERY);
    }
    
    /**
     * 期数 已开奖
     * @param Request $request
     * @return type
     */
    public function haslottery(Request $request) {
        return $this->index($request, PeriodLogic::PERIODS_HASLOTTERY);
    }
    
}
