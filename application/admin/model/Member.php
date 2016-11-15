<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-10-29 11:35:45
 * @version V1.0
 * @desc   
 */
class Member extends User {

// 定义全局的查询范围
    protected function base($query) {
        $map['status'] = 1;
        $query->where($map);
    }

}
