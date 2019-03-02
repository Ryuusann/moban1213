<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;





/*
* 文章阅读次数
*/
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
    }
    echo $row['views'];
}
/*
* 文章第一张图片(暂时没用)
*/
function showThumbnail($widget) {
    $attach = $widget->attachments(1)->attachment;
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
    if (preg_match_all($pattern, $widget->content, $thumbUrl)) {
    echo $thumbUrl[1][0];
    } else
    if ($attach->isImage) {
    echo $attach->url;
    } else {
    echo $random;
    } 
}


/*评论增加@功能*/
function getPermalinkFromCoid($coid) {   
    $db       = Typecho_Db::get();   
    $options  = Typecho_Widget::widget('Widget_Options');   
    $contents = Typecho_Widget::widget('Widget_Abstract_Contents');   
    
    $row = $db->fetchRow($db->select('cid, type, author, text')->from('table.comments')   
              ->where('coid = ? AND status = ?', $coid, 'approved'));   
    
    if (empty($row)) return 'Comment not found!';   
    $cid = $row['cid'];   
    
    $select = $db->select('coid, parent')->from('table.comments')   
              ->where('cid = ? AND status = ?', $cid, 'approved')->order('coid');   
    
    if ($options->commentsShowCommentOnly)   
        $select->where('type = ?', 'comment');   
    
    $comments = $db->fetchAll($select);   
    
    if ($options->commentsOrder == 'DESC')   
        $comments = array_reverse($comments);   
    
    foreach ($comments as $key => $val)   
        $array[$val['coid']] = $val['parent'];   
    
    $i = $coid;   
    while ($i != 0) {   
        $break = $i;   
        $i = $array[$i];   
    }   
    
    $count = 0;   
    foreach ($array as $key => $val) {   
        if ($val == 0) $count++;    
        if ($key == $break) break;    
    }   
    
    $parentContent = $contents->push($db->fetchRow($contents->select()->where('table.contents.cid = ?', $cid)));   
    $permalink = rtrim($parentContent['permalink'], '/');   
    
    $page = ($options->commentsPageBreak)   
          ? '/comment-page-' . ceil($count / $options->commentsPageSize)   
          : ( substr($permalink, -5, 5) == '.html' ? '' : '/' );   
    
    return array(   
        "author" => $row['author'],   
        "text" => $row['text'],   
        "href" => "{$permalink}{$page}#{$row['type']}-{$coid}"  
    );   
    }  

    /*
    * 热门文章
    */
    function getHotComments($limit = 10){
        $db = Typecho_Db::get();
        $result = $db->fetchAll($db->select()->from('table.contents')
            ->where('status = ?','publish')
            ->where('type = ?', 'post')
            ->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
            ->limit($limit)
            ->order('commentsNum', Typecho_Db::SORT_DESC)
        );
        if($result){
            foreach($result as $val){            
                $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
                $post_title = htmlspecialchars($val['title']);
                $permalink = $val['permalink'];
                echo '<li><a href="'.$permalink.'" title="'.$post_title.'" >'.$post_title.'</a></li>';        
            }
        }
    }

/*
* 自定义字段
*/
function themeFields($layout) {
    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('输入缩略图地址    <script src="https://cdn.peela.cn/jquery.min.js"></script><style>.wmd-button-row {height:auto;}.copyright p:after {content: "你正在使用Angin付费版";margin-left: 6px;font-size: 12px;}</style>'));
    $layout->addItem($thumb);
}

function img_postthumb($content) {
    preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $content, $thumbUrl);  //通过正则式获取图片地址
    $img_src = $thumbUrl[1][0];  //将赋值给img_src
    $img_counter = count($thumbUrl[0]);  //一个src地址的计数器
     if($img_counter > 0){
         for($i=0;$i<$img_counter;$i++){
             echo "<img class='image-link mdui-hoverable' src='".$thumbUrl[1][$i]."' />";
         }
     }   
 }


/*
* 主题后台
*/
function themeConfig($form) {
    $logotitle = new Typecho_Widget_Helper_Form_Element_Text('logotitle', NULL, NULL, _t('右侧栏昵称'), _t('必填,没有设定字数，请酌情填写'));
    $form->addInput($logotitle);
    $logotxt = new Typecho_Widget_Helper_Form_Element_Text('logotxt', NULL, NULL, _t('右侧栏介绍/签名'), _t('必填,没有设定字数，请酌情填写'));
    $form->addInput($logotxt);
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('头像地址'), _t('支持 https:// 或 //,必填'));
    $form->addInput($logoUrl->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('favicon地址'), _t('支持 https:// 或 //,留空则不设置favicon'));
    $form->addInput($favicon->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
     $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL,NULL, _t('文章置顶'), _t('置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔'));
    $form->addInput($sticky);
    $adContentSidebar = new Typecho_Widget_Helper_Form_Element_Text('adContentSidebar', NULL, NULL, _t('全站右侧广告位'), _t('可以写HTML或者其它' ));
    $form->addInput($adContentSidebar);
    $articlesImg = new Typecho_Widget_Helper_Form_Element_Text('articlesImg', NULL, NULL, _t('归档顶部图片(已默认添加黑白滤镜)'), _t('例:https://ww1.sinaimg.cn/large/005BYqpgly1fza1xgvtrmj30go0godfz.jpg' ));
    $form->addInput($articlesImg);
}

