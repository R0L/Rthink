<?php
namespace application\common\taglib;
use think\template\TagLib;

class My extends TagLib {

    // 定义标签
    protected $tags = [
        'ueditor' => ['attr' => 'name,content,width,height', 'close' => 0],
        'umeditor' =>['attr' => 'name,content,width,height', 'close' => 0],
        'webuploader' =>['attr' => 'name,url,list,limit', 'close' => 0],
    ];



    /**
     * 引入umeidter编辑器
     * @param string $tag  name:表单name content：编辑器初始化后 默认内容
     */
    public function tagUmeditor($tag) {
        $name = isset($tag["name"]) ? $tag["name"] : "content";
        $content = isset($tag["content"]) ? $tag["content"] : "";
        $content     = $this->autoBuildVar($content);
        $height = isset($tag["height"]) ? $tag["height"] : "320";
        $width = isset($tag["width"]) ? $tag["width"] : "1000";
        $parse ='<?php 
          echo "<link rel=\"stylesheet\" href=\"/static/umeditor1_2_2/themes/default/css/umeditor.min.css\">
                <script src=\"/static/umeditor1_2_2/umeditor.config.js\"></script>
                <script src=\"/static/umeditor1_2_2/umeditor.js\"></script>
                <script src=\"/static/umeditor1_2_2/lang/zh-cn/zh-cn.js\"></script>
                <script id=\"container\" name=\"'.$name.'\" type=\"text/plain\" >".'.$content.'."</script>
                <script>
                        $(function(){
                           window.um = UM.getEditor(\"container\",{
                               initialFrameHeight:\"'.$height.'\",
                               initialFrameWidth:\"'.$width.'\"
                            });
                        });
                    </script>";
                ?>';
        return $parse;
    }

    /**
     * 引入ueidter编辑器
     * @param string $tag  name:表单name content：编辑器初始化后 默认内容
     */
    public function tagUeditor($tag) {
        $name = isset($tag['name']) ? $tag['name'] : 'content';
        $content = isset($tag['content']) ? $tag['content'] : '';
        $height = isset($tag['height']) ? $tag['height'] : '300';
        $width = isset($tag["width"]) ? $tag["width"] : "1000";
        $parse = <<<EOF
                <?php
                echo '<script id="container" name="$name" type="text/plain">$content</script>';
                echo '<script src="/static/ueditor1_4_3_3/ueditor.config.js"></script>';
                echo '<script src="/static/ueditor1_4_3_3/ueditor.all.js"></script>';
                echo "<script>
                            var um = UE.getEditor('container',{
                                initialFrameHeight:$height,
                                initialFrameWidth:$width,
                                toolbars: [[
                                    'fullscreen',  'undo', 'redo', '|',
                                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                    'directionalityltr', 'directionalityrtl', 'indent', '|',
                                    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                    'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                    'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
                                    'horizontal', 'date', 'time', 'spechars', '|',
                                    'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                     'searchreplace', 'drafts'
                                ]],
                                autoHeightEnabled:false,
                                catchRemoteImageEnable:true
                            });
                        </script>";
                ?>
EOF;
        
        return $parse;
    }

    /**
     * 上传标签
     * @param string $tag  
     * url：上传的图片处理的控制器方法   
     * name：表单name   
     * word：提示文字
     */
    public function tagWebuploader($tag) {
        $url = isset($tag['url']) ? $tag['url'] : url('admin/Attach/upload');
        $name = isset($tag['name']) ? $tag['name'] : 'file_name';
        $list = empty($tag['list']) ? $tag['list'] : null;
        $limit = isset($tag['limit']) ? $tag['limit'] : '5'; // 张数
        $init_data = "";
        if($list){
            $list = explode(',',$list);
            foreach($list as $value){
               $init_data .="<div class=\"file-item thumbnail\">".get_cover_html($value)."<input type=\"hidden\" value=\"{$value}\" name=\"{$name}[]\"></div>";
            }
            
        }
        $limit-=count($list);
        $parse=<<<EOF
                <?php
                echo '<link rel="stylesheet" type="text/css" href="/static/webuploader-0.1.5/webuploader.css">';
                echo '<script type="text/javascript" src="/static/webuploader-0.1.5/webuploader.js"></script>';
                echo '<div id="uploader"><div id="fileList" class="uploader-list">';
                echo '$init_data';
                echo '</div><div id="filePicker">选择图片</div></div>';
                echo "<script>
                        // 初始化Web Uploader
                        var uploader = WebUploader.create({

                            // 选完文件后，是否自动上传。
                            auto: true,

                            // swf文件路径
                            swf: '/static/webuploader-0.1.5/Uploader.swf',

                            // 文件接收服务端。
                            server: '$url',

                            // 选择文件的按钮。可选。
                            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                            pick: '#filePicker',

                            // 只允许选择图片文件。
                            accept: {
                                title: 'Images',
                                extensions: 'gif,jpg,jpeg,bmp,png',
//                                mimeTypes: 'image/*'
//                                mimeTypes: 'image/jpg,image/jpeg,image/png'
                            },
                            
                            fileNumLimit:$limit, //限制图片数量
                            duplicate :true,    //是否支持图片重复上传
                        });
                        // 当有文件添加进来的时候
                        uploader.on( 'fileQueued', function( file ) {
                            var _li = $(
                                    '<div id=\"' + file['id'] + '\" class=\"file-item thumbnail\">' +
                                        '<img>' +
                                        '<input type=\"hidden\" name=\"{$name}[]\">'+
                                    '</div>'
                                    );
                                _img = _li.find('img');


                            //_list为容器jQuery实例
                            $('#fileList').append( _li );

                            // 创建缩略图
                            // 如果为非图片文件，可以不用调用此方法。
                            // thumbnailWidth x thumbnailHeight 为 100 x 100
                            uploader.makeThumb( file, function( error, src ) {
                                if ( error ) {
                                    _img.replaceWith('<span>不能预览</span>');
                                    return;
                                }

                                _img.attr( 'src', src );
                            }, 60, 60 );
                        });
                        // 文件上传过程中创建进度条实时显示。
                        uploader.on( 'uploadProgress', function( file, percentage ) {
                            var _li = $( '#'+file.id ),
                                _percent = _li.find('.progress span');

                            // 避免重复创建
                            if ( !_percent.length ) {
                                _percent = $('<p class=\"progress\"><span></span></p>')
                                        .appendTo( _li )
                                        .find('span');
                            }

                            _percent.css( 'width', percentage * 100 + '%' );
                        });

                        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                        uploader.on( 'uploadSuccess', function( file ,response) {
                            $( '#'+file.id ).addClass('upload-state-done');
                            $( '#'+file.id ).find('input').val(response.pic_id);
                        });

                        // 文件上传失败，显示上传出错。
                        uploader.on( 'uploadError', function( file ) {
                            var _li = $( '#'+file.id ),
                                _error = _li.find('div.error');

                            // 避免重复创建
                            if ( !_error.length ) {
                                _error = $('<div class=\"error\"></div>').appendTo( _li );
                            }

                            _error.text('上传失败');
                        });

                        // 完成上传完了，成功或者失败，先删除进度条。
                        uploader.on( 'uploadComplete', function( file ) {
                            $( '#'+file.id ).find('.progress').remove();
                        });
                    </script>";
                ?>
EOF;
        return $parse;
    }

}