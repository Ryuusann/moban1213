<?php

/**
 * “也许，我还可以更精致”

 * @package Angin
 * @author Clear
 * @version 1.2.3
 * @link https://peela.cn/
 */


if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
/** 文章置顶 */
$sticky = $this->options->sticky;
if($sticky && $this->is('index') || $this->is('front')){
    $sticky_cids = explode(',', strtr($sticky, ' ', ','));//分割文本 
    $sticky_html = "<span style='color: #fa4545;'><i style='    font-size: 14px;' class=\"mdui-icon material-icons\">&#xe255;</i> </span>"; //置顶标题的 html
    $db = Typecho_Db::get();
    $pageSize = $this->options->pageSize;
    $select1 = $this->select()->where('type = ?', 'post');
    $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time());
    //清空原有文章的列队
    $this->row = [];
    $this->stack = [];
    $this->length = 0;
    $order = '';
    foreach($sticky_cids as $i => $cid) {
        if($i == 0) $select1->where('cid = ?', $cid);
        else $select1->orWhere('cid = ?', $cid);
        $order .= " when $cid then $i";
        $select2->where('table.contents.cid != ?', $cid); //避免重复
    }
    if ($order) $select1->order(null,"(case cid$order end)"); //置顶文章的顺序 按 $sticky 中 文章ID顺序
    if ($this->_currentPage == 1) foreach($db->fetchAll($select1) as $sticky_post){ //首页第一页才显示
        $sticky_post['sticky'] = $sticky_html;
        $this->push($sticky_post); //压入列队
    }
$uid = $this->user->uid; //登录时，显示用户各自的私密文章
    if($uid) $select2->orWhere('authorId = ? && status = ?',$uid,'private');
    $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->_currentPage, $this->parameter->pageSize));
    foreach($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
    $this->setTotal($this->getTotal()-count($sticky_cids)); //置顶文章不计算在所有文章内
}

?>

    <div class="in-container">
        <div class="mdui-col-xs-12 mdui-col-sm-12 mdui-col-md-9 mdui-col-offset-md-1">
            <div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-9 " id="pajx">
                <div></div>
                <div class="mdui-col-xs-12 mdui-color-white mdui-text-color-theme-secondary in-container-bootem">
                    <div class="in-container-top">
                    <a href="<?php $this->options->siteUrl(); ?>" class="in-cntainer-top-a"><i class="mdui-icon material-icons">&#xe893;</i> 最新 <i class="mdui-icon material-icons">&#xe5cc;</i> <?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?> </a>
                        <a href="<?php $this->options->siteUrl(); ?>" class="mdui-float-right"><i class="mdui-icon material-icons">&#xe87c;</i> <?php $this->options->title() ?></a>
                        <a href="" class="mdui-float-right"><i class="mdui-icon material-icons">&#xe5d4;</i> </a>
                      
                    </div>
                </div>
              <?php while($this->next()): ?>
                <div class="mdui-col-xs-12 mdui-color-white mdui-text-color-theme-secondary in-container-bootem in-container-text">
                
                    <p class="in-container-time mdui-float-right"><?php $this->date('F j, Y'); ?> </p>
                    <p class="in-container-about"><img class="mdui-img-circle" src="<?php $this->options->logoUrl();?>" alt="<?php $this->options->title() ?>"><b><a href="<?php $this->permalink() ?>" class="in-a"><?php $this->author(); ?> · <?php $this->title() ?> <a style="text-decoration: none;     background: rgb(238, 238, 238);" href="<?php $this->permalink() ?>"><?php $this->sticky(); ?></a></a></b></p>
                    <div class="mdui-divider"></div>
                    <div class="in-conntainer-title"><a href="<?php $this->permalink() ?>">
                    <?php 
                     $this->excerpt(250);
                    ?>
                       <div class="in-conntainer-img"> <?php echo img_postthumb($this->content); ?> </div></a>
                      </a>
                    </div>
                    <div class="in-conntainer-font mdui-col-md-12">
                        <p class="mdui-col-sm-4 mdui-col-md-2"><i class="mdui-icon material-icons">&#xe80e;</i> 热度 <span><?php get_post_view($this) ?>℃</span></p>
                        <p class="in-angcom mdui-col-sm-4 mdui-col-md-2 in-commmm"><i class="mdui-icon material-icons">&#xe8cd;</i> 评论 <span>+<?php $this->commentsNum('%d '); ?></span></p>
                        <p class="mdui-float-right" style="    padding-right: 2em;"><i class="mdui-icon material-icons">&#xe89a;</i><a href=""><?php $this->category(','); ?> <p>
                    </div> 
                    <div class="in-conntainer-com mdui-col-md-12" >
                      <?php $this->need('ang/comment.php'); ?>
                    
                    </div>
                           </div><?php endwhile; ?>
                           <?php $this->pageNav(); ?>
                </div>
               

            <?php $this->need('sidebar.php'); ?>
        </div>        
    </div>
    <?php $this->need('footer.php'); ?>