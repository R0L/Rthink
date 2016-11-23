<?php

namespace application\common\model;

/**
 * 行为模型
 */
class Action extends Base {

    //自动完成
    protected $auto = [];
    protected $insert = [];
    protected $update = [];

    // 定义全局的查询范围
    protected function base($query) {
        $query->where(true);
    }

}
