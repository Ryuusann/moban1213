<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <meta itemprop="image" content="<?php $this->options->favicon(); ?>" />
  <link rel="icon" type="image/ico" href="<?php $this->options->favicon(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php $this->keywords(); ?>" />
  <meta itemprop="name" content="比你们都好看，哈哈哈哈" />
  <meta name="description"  itemprop="description"  content="<?php $this->options->description() ?>" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="stylesheet" type="text/css" media="all" href="https://cdn.peela.cn/mdui/assets/css/mdui.min.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php $this->options->themeUrl('style.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="https://cdn.peela.cn/highight/styles/vs.css" />
    <link rel="stylesheet" type="text/css" media="all" href="https://cdn.peela.cn/pjax/nprogress.css" />
     <link rel="stylesheet" type="text/css" media="all" href="<?php $this->options->themeUrl('libs/zoom.css'); ?>" />
    <script src="https://cdn.peela.cn/pjax/nprogress.js"></script> 
    <script src="https://cdn.peela.cn/jquery.min.js"></script>
</head>
<body class="mdui-color-grey-200">
    <div class="mdui-container-fluid mdui-color-white">
       <div class="mdui-row">
            <div class="mdui-col-xs-12 mdui-col-sm-12 mdui-col-md-9 mdui-col-offset-md-1 in-menu-top-left">
              <?php $this->widget('Widget_Contents_Page_List')
               ->parse('<a href="{permalink}">{title}</a>'); ?>

                    <p href="" class="mdui-float-right top-user" mdui-menu="{target: '#demo-attr-cascade'}">Login</p>
                    <div  class="mdui-menu mdui-menu-cascade top-about" id="demo-attr-cascade">
                    <form action="<?php $this->options->loginaction(); ?>" method="post" class="top-login"><h3>Login</h3>
            <p>
<input type="text" id="name" name="name" value="" placeholder="用户名"  >
<input type="password" id="password" name="password" placeholder="密码">
            </p>
            <p>
 <button type="submit" class="btn btn-l w-100 primary"  id="loginbutton">登录</button>
<input type="hidden" name="referer" value="<?php $this->options->adminUrl(); ?>">
            </p>
           
        </form>
  <?php if($this->user->hasLogin()):?>
        <script>
        $(".top-user").text("hi,<?php $this->user->screenName(); ?>");
        $(".top-login").hide();
        </script>
         <div class="top-us">
          <img class="mdui-img-circle" src="<?php $this->options->logoUrl();?>" alt="<?php $this->options->title() ?>">
          <h4><?php $this->user->screenName(); ?> <a href="<?php $this->options->adminUrl(); ?>">去后台 >></a></h4>
         </div>
         <div class="mdui-divider"></div>
         <div class="top-zz">
          <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
          <p>文章总数：<?php $stat->publishedPostsNum() ?>篇</p>
          <p>分类总数：<?php $stat->categoriesNum() ?>个</p>
          <p>评论总数：<?php $stat->publishedCommentsNum() ?>条</p>
          <p>页面总数：<?php $stat->publishedPagesNum() ?>个</p>
          <p>当前作者的文章总数：<?php $stat->myPublishedPostsNum() ?>篇</p>
          <p>  运行于:Typecho，当前版本:<?php $this->options->Version(); ?></p> 
        </div>
<?php endif;?>
                    </div>
            </div>
        </div>
    </div>
