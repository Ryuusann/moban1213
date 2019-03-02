<?php
/**
* 友情链接
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="in-container">
<div class="mdui-col-xs-12 mdui-col-sm-12 mdui-col-md-9 mdui-col-offset-md-1" >
<div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-9 " id="pajx">
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
<div class="mdui-col-xs-12 mdui-color-white mdui-text-color-theme-secondary in-container-bootem ">
<div class="mdui-tab mdui-tab-full-width" mdui-tab>
  <a href="#example1-tab1" class="mdui-ripple  mdui-tab-active">友链申请</a>
  <a href="#example1-tab2" class="mdui-ripple ">链接</a>
</div>
<div id="example1-tab1" class="mdui-p-a-2"><div class="cn-container mdui-typo"><?php $this->content(); ?></div></div>
<div id="example1-tab2" class="mdui-p-a-2 ab-container">
    <h2>友情链接</h2>
    <ul class="mdui-list mdui-list-dense">
       <?php 
         $mypattern = <<<eof
         <li class="mdui-list-item mdui-ripple"><a href="{url}" target="_blank" class="links-a"><div class="mdui-list-item-content">{name}</div>
         </a><div class="mdui-list-item-avatar"><img src="{image}"/></div></li>
eof;
       
       
       Links_Plugin::output($mypattern, 0, "ten");?>
    </ul>

    <h2>推荐链接</h2>
    <ul class="mdui-list mdui-list-dense">
    <?php  Links_Plugin::output($mypattern, 0, "good");?>
    </ul>

</div>

</div>
<?php $this->need('comments.php'); ?>
</div>
<?php $this->need('sidebar.php'); ?>
</div>
</div>
<?php $this->need('footer.php'); ?>