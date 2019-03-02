<div class="mdui-col-xs-12 mdui-col-sm-12  in-footer">
© 2018 · <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a> · <a href="<?php $this->options->feedUrl(); ?>" target="_blank">Entries (RSS)</a> 
</div>

<a href="#" class="mdui-fab mdui-fab-mini mdui-color-black mdui-fab-fixed" style="transition-delay: 15ms;display:none;" id="back-to-top"><i class="mdui-icon material-icons">touch_app</i></a>

 <script src="https://cdn.peela.cn/mdui/assets/js/mdui.min.js"></script>
 <script src="https://cdn.peela.cn/jquery.pjax.min.js"></script>
 <script src="https://cdn.peela.cn/highight/highlight.pack.js"></script>
<script src="https://cdn.peela.cn/transition.js"></script> 
<script src="<?php $this->options->themeUrl('libs/zoom.js'); ?>"></script>
 <script src="<?php $this->options->themeUrl('js/min.js'); ?>"></script>
 <script>
 //pjax 刷新
$(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax])', {
    container: '#pajx',
    fragment: '#pajx',
    timeout: 8000
}).on('pjax:send',
function() {
    NProgress.start();//加载动画效果开始

}).on('pjax:complete',
function() {
NProgress.done();//加载动画效果结束
reHighlightCodeBlock();
inAng();
zoomJs();
yanzheng();
yNu();
loginButton();
mdui.mutation();  // 选项卡事件
});
       

 </script>
</body>
</html>