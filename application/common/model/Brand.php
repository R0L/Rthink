<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-8 14:58:12
 * @version V1.0
 * @desc   
 */
class Brand extends BaseCommon {

    public function category(){
        return $this->belongsTo('Category',"category_id","id");
    }
    

}
