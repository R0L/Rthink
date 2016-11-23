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
    public static function delCache() {
        self::delDir(CACHE_PATH);
    }
    /**
     * 删除LOG
     */
    public static function delLog() {
        self::delDir(LOG_PATH);
    }
    /**
     * 删除html静态模板
     */
    public static function delHtml() {
//        self::delDir(HTNL_PATH);
    }
    /**
     * 删除页面模板
     */
    public static function delTemp() {
        self::delDir(TEMP_PATH);
    }
    /**
     * 删除所有
     */
    public static function delAll() {
        self::delDir(RUNTIME_PATH);
    }

    /**
     * 删除文件夹
     * @param type $dir
     */
    private static function delDir($dir) {
        if ($handle = opendir($dir)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    if (is_dir("$dir/$item")) {
                        self::delDir("$dir/$item");
                    } else {
                        unlink("$dir/$item");
                    }
                }
            }
            closedir($handle);
            rmdir($dir);
        }
    }

}
