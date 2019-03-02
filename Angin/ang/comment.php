<div>                     <!-- 判断设置是否允许对当前文章进行评论 -->
<?php if($this->allow('comment')): ?>
 
 <h4 id="response"></h4>

 <!-- 输入表单开始 -->
 <form method="post" action="<?php $this->commentUrl() ?>" >

     <!-- 如果当前用户已经登录 -->
     <?php if($this->user->hasLogin()): ?>
         <!-- 显示当前登录用户的用户名以及登出连接 -->
         <p>Logged in as <a href="<?php $this->options->adminUrl(); ?>"><?php $this->user->screenName(); ?></a>. 
         <a href="<?php $this->options->index('Logout.do'); ?>" title="Logout">Logout &raquo;</a></p>

     <!-- 若当前用户未登录 -->
     <?php else: ?>
     <div class="commtxt">
                <input type="text" name="author" class="text mdui-col-xs-4" size="35" value="<?php $this->remember('author'); ?>" placeholder="nickname*"/>
                <input type="text" name="mail" class="text mdui-col-xs-4" size="35" value="<?php $this->remember('mail'); ?>"placeholder="e-mail*" />
                <input type="text" name="url" class="text mdui-col-xs-4" size="35" value="<?php $this->remember('url'); ?>" placeholder="https://" />
            </div>
     <?php endif; ?>

    <textarea class="textarea mdui-col-xs-12 OwO-textarea" name="text" rows="5" placeholder="Write something..." ></textarea> <div title="OwO" class="OwO"></div> 
      <div class="com-submit">
         <div class="yanz">
                  <p class="yanz-a"></p>
                  <p class="yanz-b"></p>
                   <input type="text" class="y-nu" oninput = "value=value.replace(/[^\d]/g,'')" maxlength="3" placeholder="?">
              </div>  </div>
 </form>
<?php endif; ?>
  </div>