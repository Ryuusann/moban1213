<div class="mdui-col-xs-12 mdui-col-sm-4 mdui-col-md-3">
                    <div class="mdui-col-xs-12 mdui-color-white mdui-text-color-theme-secondary in-container-bootem in-about"> 
                        <p class="in-about-close mdui-float-right">
                            <span>-</span>
                            <span>+</span> 
                            <span>×</span></p>
                        <div class="in-about-ang">
                            <div class="in-about-ang-img"><img class="mdui-img-circle"  src="<?php $this->options->logoUrl();?>" alt="<?php $this->options->title() ?>"></div>
                            <div class="in-about-ang-tit"><h4> <?php $this->options->logotitle(); ?></h4><span><?php $this->options->logotxt(); ?></span></div>
                        </div>
                        <div class="mdui-divider"></div>
                        <div class="in-about-tj">
                        <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
                            <p> <?php $stat->publishedPagesNum() ?><span>页面</span></p>
                            <p><?php $stat->publishedPostsNum() ?><span>文章</span></p>
                            <p class="in-about-tj-this"><?php $stat->publishedCommentsNum() ?><span>评论</span></p>
                        </div>                  

                    </div>


                    <div class="mdui-col-xs-12 mdui-color-white mdui-text-color-theme-secondary in-container-bootem in-about"> 
                    <form method="post" action="">
                          <div class="search">
                          <input type="text" name="s" class="text search-a" size="32" placeholder="搜点什么..?" /> 
                          <input type="submit" class="submit submit-a" value="Search" />
                          </div>
                     </form>
                    </div>
                    <div class="mdui-col-xs-12  mdui-text-color-theme-secondary in-container-bootem in-about">
                        <div class="in-void">
                            <p> <?php $this->options->adContentSidebar(); ?></p>
                        </div>
                    </div>

                     <div class="mdui-col-xs-12 mdui-color-white mdui-text-color-theme-secondary in-container-bootem in-about">
                         <p class="in-title">热门文章</p>
                         <ul class="in-hot">
                         <?php getHotComments('10');?>
                        </ul>
                     </div>
            </div>