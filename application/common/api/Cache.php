<?php

namespace application\common\api;

/**
 * @author ROL
 * @date 2016-11-22 15:28:49
 * @version V1.0
 * @desc   
 */
class Cache {

    /**
     * 删除缓存
     */
    public function delCache() {
        $this->delDir(CACHE_PATH);
    }
    /**
     * 删除LOG
     */
    public function delLog() {
        $this->delDir(LOG_PATH);
    }
    /**
     * 删除html静态模板
     */
    public function delHtml() {
//        $this->delDir(HTNL_PATH);
    }
    /**
     * 删除页面模板
     */
    public function delTemp() {
        $this->delDir(TEMP_PATH);
    }
    /**
     * 删除所有
     */
    public function delAll() {
        $this->delDir(RUNTIME_PATH);
    }

    /**
     * 删除文件夹
     * @param type $dir
     */
    function delDir($dir) {
        if ($handle = opendir($dir)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    if (is_dir("$dir/$item")) {
                        delDir($dir / $item);
                    } else {
                        unlink($dir / $item);
                    }
                }
            }
            closedir($handle);
            rmdir($dir);
        }
    }

}
