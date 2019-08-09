$(document).ready(
    function () {
        var $nav_height = $("#nav").outerHeight();
        var $bigtitle = $('#bigtitle').outerHeight();
        $('.wrapper').height($bigtitle);
        $("#header").height($bigtitle);
        $('#BodyContents').css('margin-top', $nav_height);
        _scroll();
        $('#yzm').load(function () {
            $('#LoginProgress').addClass('mdui-hidden');
        });
    }
);

function login() {
    var data = $("#login").serialize();
    $.ajax({
        type: 'post',
        url: "/ajax.php?fun=login",
        data: data,
        success: function (json) {
            var array=JSON.parse(json);
            if (array.status){
                mdui.snackbar({
                    message: '登陆成功,三秒后跳转!',
                    position: 'right-top'
                  });
                  location.reload();
            }else{
                if (array.code==-10){
                    mdui.snackbar({
                        message: '登录失败,请检查账号密码',
                        position: 'right-top'
                      });
                }
                if (array.code==-20){
                    mdui.snackbar({
                        message: '登录失败,请检查验证码',
                        position: 'right-top'
                      });
                }
            }
            $('#LoginProgress').addClass('mdui-hidden');
            document.getElementById('yzm').src='/captcha.php?id='+Math.random();
        }
    });
}



function _scroll() {
    var $nav_height = $("#nav").outerHeight();
    var $bigtitle = $('#bigtitle').outerHeight();
    var scrollTop = $(window).scrollTop();
    if (scrollTop < $bigtitle - $nav_height) {
        if ($('.nav').hasClass('shadow')) {
            $('.nav').addClass("ac");
        }

        $('.nav').removeClass("bb");
        $('.nav').removeClass("c");
        $('.nav').removeClass("shadow");
        $('#main-title').addClass("mdui-hidden");
        $('#sub-title').addClass("mdui-hidden");

    } else {

        $('.nav').removeClass("ac");
        $('.nav').addClass("shadow");
        $('.nav').addClass("c");
        $('#main-title').removeClass("mdui-hidden");
        $('#sub-title').removeClass("mdui-hidden");
    }
}
$(window).on('scroll', function () {
    _scroll()
});


function closePage() {
    $('#accp').removeProp('checked');
    var userAgent = navigator.userAgent;
    if (userAgent.indexOf("Firefox") != -1 || userAgent.indexOf("Chrome") != -1) {
        window.open("", "_self").close();
    } else {
        window.opener = null;
        window.open("", "_self");
        window.close();
        window.location.href = "about:blank";
        window.close();
    }
    alert('请手动关闭本标签页');

}