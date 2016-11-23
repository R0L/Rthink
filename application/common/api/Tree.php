<?php

namespace application\common\api;

/**
 * 生成多层树状下拉选框的工具模型
 */
class Tree {

    /**
     * 把返回的数据集转换成Tree
     * @access public
     * @param array $list 要转换的数据集
     * @param string $pid parent标记字段
     * @param string $level level标记字段
     * @return array
     */
    public function toTree($list = null, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
        $tree = array();
        if (is_array($list)) {
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = & $list[$key];
                $refer[$data[$pk]]->data($child, [])->append([$child]);
            }
            foreach ($list as $key => $data) {
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] = & $list[$key];
                    end($tree)->data($child, [])->append([$child]);
                } else if (isset($refer[$parentId])) {
                    $parent = & $refer[$parentId];
                    $childtemp = $parent->$child;
                    $childtemp[] = & $list[$key];
                    $parent->data($child, $childtemp);
                }
            }
        }
        return $tree;
    }

}
