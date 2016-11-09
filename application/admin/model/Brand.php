<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-8 14:58:12
 * @version V1.0
 * @desc   
 */
class Brand extends Base {

    public function category(){
        return $this->belongsTo('Category',"category_id","id");
    }
    

}
