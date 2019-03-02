 <?php $this->header('commentReply=1&description=0&keywords=0&generator=0&template=0&pingback=0&xmlrpc=0&wlw=0&rss2=0&rss1=0&antiSpam=0&atom'); ?>
<div id="comments">
    
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>

<li id="li-<?php $comments->theId(); ?>" class="comment-body mdui-col-xs-12 mdui-color-white com-cn<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>">
        <div class="comment-author">
            
            <?php $comments->gravatar('40', ''); ?>
            <div class="comment-about">
            <cite class="fn"><?php $comments->author(); ?>  <?php if ($comments->authorId) {
                if ($comments->authorId == $comments->ownerId) {
                    echo "<span class='author-after-text'>帅气的博主</span>";
                }?>
            <?php }?></cite>
            <div class="comment-meta">
            <a href="<?php $comments->permalink(); ?>" class="mdui-text-color-theme-secondary com-time"><?php $comments->date('F j, Y'); ?></a>
            <span class="comment-reply"><?php $comments->reply(); ?></span>
            </div>
            </div>
           
        </div>
        <?php  
if($comments->parent){   
    $p_comment = getPermalinkFromCoid($comments->parent);   
    $p_author = $p_comment['author'];   
    $p_text = mb_strimwidth(strip_tags($p_comment['text']), 0, 100,"...");   
    $p_href = $p_comment['href'];   
    echo "<div class='comments-connt'><a href='$p_href' title='$p_text'>@$p_author</a>";   
}   
?> 
        <?php $comments->content(); ?>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children commtent-right-s">
        <?php $comments->threadedComments($options); ?>
   
    </div>
    
<?php } ?>
</li>
<?php } ?>

<?php $this->comments()->to($comments); ?>
<?php if($this->allow('comment')): ?>

<?php if ($comments->have()): ?><!--如果有评论的才会输出-->

    <!--输出评论列表-->
<?php $comments->listComments(); ?>
    <!--评论分页-->
    <div class="mdui-col-xs-12 ">
<?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>  </div>
<?php endif; ?>
<!-- 判断设置是否允许对当前文章进行评论 -->
<div id="<?php $this->respondId(); ?>" class="respond">
    <!-- 输入表单开始 -->
    <form method="post" action="<?php $this->commentUrl() ?>" id="comment_form" class="comment-body mdui-col-xs-12 mdui-color-white com-cn">
 
	     
        <!-- 如果当前用户已经登录 -->
        <?php if($this->user->hasLogin()): ?>
            <!-- 显示当前登录用户的用户名以及登出连接 -->
            <p>Logged in as <a href="<?php $this->options->adminUrl(); ?>"><?php $this->user->screenName(); ?></a>. 
            <a href="<?php $this->options->index('Logout.do'); ?>" title="Logout">Logout &raquo;</a></p>
 
        <!-- 若当前用户未登录 -->
        <?php else: ?>
            <!-- 要求输入名字、邮箱、网址 -->

            <div class="commtxt">
                <input type="text" name="author" class="text mdui-col-xs-4" size="35" value="<?php $this->remember('author'); ?>" placeholder="nickname*"/>
                <input type="text" name="mail" class="text mdui-col-xs-4" size="35" value="<?php $this->remember('mail'); ?>"placeholder="e-mail*" />
                <input type="text" name="url" class="text mdui-col-xs-4" size="35" value="<?php $this->remember('url'); ?>" placeholder="https://" />
            </div>
          
      
        <?php endif; ?>
              <!-- 输入要回复的内容 -->
              <textarea id="comment" class="textarea mdui-col-xs-12" name="text" rows="5" placeholder="Write something..." ></textarea> 
      <div class="com-submit">
            <div class="cancel-comment-reply"><?php $comments->cancelReply(); ?></div>    
           
            
   
       
 
           <div class="yanz">
                 <p class="yanza"></p>
                  <p class="yanzb"></p>
                   <input type="text" class="y-nu" oninput = "value=value.replace(/[^\d]/g,'')" maxlength="3" placeholder="?">
              </div>  </div>
    </form>
    </div>
<?php endif; ?>
</div>
