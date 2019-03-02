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
        <h2 style="color:#000;"><?php $this->title(); ?></h2>
        
        <div class="mdui-divider"></div>
        <div class="cn-container mdui-typo"><?php $this->content(); ?></div>
    </div>

<?php $this->need('comments.php'); ?>
</div>
<?php $this->need('sidebar.php'); ?>
</div>
</div>

</div>
<?php $this->need('footer.php'); ?>