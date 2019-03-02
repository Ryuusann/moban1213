
$(document).ready(function(){
    hljs.initHighlightingOnLoad();
    $(".in-footer").prepend('<p>Theme <a href="https://peela.cn/" target="_blank">Angin</a> By <a href="https://peela.cn/" target="_blank">CLEAR</a></p> ');
  zoomJs();
   inAng();
   yNu();
});

/*
* 代码高亮
*/
function reHighlightCodeBlock(){
    $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
      });
}
/*
* 生成随机数
*/
function yanzheng(){
     var tow = Math.round(Math.random()*20);
    var floa = Math.round(Math.random()*40);
    var arr =[]
    arr.push(tow)
    arr.push(floa)
    return arr
}

function inAng(){ 
 $(".in-angcom").click(function(){
    var a = $(".in-angcom").index(this)
    //显示评论区域
    $('.in-conntainer-com').eq(a).css({
        display:'block'
    })
     //调用验证方法
     var arr=yanzheng();
     $('.yanz-a').eq(a).text(arr[0]+"+");
     $('.yanz-b').eq(a).text(arr[1]+"=");
     $(function(){
        $('.y-nu').bind('input porpertychange',function(){
            if($(this).val() == (arr[0]+arr[1])){
                $('.yanz').eq(a).css({
                    display:'none'                
            });
            $('.com-submit').eq(a).append('<input type="submit" value="post it" class="submit" />');
        }
    });
 });
});
}
 function yNu(){
  
     var arr = yanzheng();
     $(".yanza").text(arr[0]+"+")
     $(".yanzb").text(arr[1]+"=")
    $('.y-nu').bind('input porpertychange',function(){
        if($(this).val() == (arr[0]+arr[1])){
            $('.yanz').css({
                 display:'none'                
            });
            $('.com-submit').append('<input type="submit" value="post it" class="submit" />');
        }
    });
 }
function zoomJs(){
        var setupContents = function () {
            $(".cn-container img:not(article .link-box img, img[no-zoom])").each(function() {
                $(this).attr('data-action', 'zoom');
                if($(this).next().is('br')){
                    $(this).next().remove();
                }
            });

        };
 setupContents();
}
$(function(){
        //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
        $(function () {
            $(window).scroll(function(){
                if ($(window).scrollTop()>100){
                    $("#back-to-top").fadeIn(1500);
                }
                else
                {
                    $("#back-to-top").fadeOut(1500);
                }
            });

            //当点击跳转链接后，回到页面顶部位置
            $("#back-to-top").click(function(){
                //$('body,html').animate({scrollTop:0},1000);
        if ($('html').scrollTop()) {
                $('html').animate({ scrollTop: 0 }, 1000);
                return false;
            }
            $('body').animate({ scrollTop: 0 }, 1000);
                 return false;            
           });       
     });    
});

 function loginButton(){
     $("#loginbutton").attr("disabled","disabled");
   $("#loginbutton").text("刷新后使用");
        $("#loginbutton").css({
        background:'rgba(0,0,0,.54)'
        
     })
 }