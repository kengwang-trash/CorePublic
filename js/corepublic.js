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
            var array = JSON.parse(json);
            if (array.status) {
                mdui.snackbar({
                    message: '登陆成功,三秒后跳转!',
                    position: 'right-top'
                });
                location.reload();
            } else {
                if (array.code == -10) {
                    mdui.snackbar({
                        message: array.msg,
                        position: 'right-top'
                    });
                } else if (array.code == -20) {
                    mdui.snackbar({
                        message: '登录失败,请检查验证码',
                        position: 'right-top'
                    });
                } else if (array.code == -871) {
                    mdui.snackbar({
                        message: 'SYSTEM ALERT: CODE871  您的账号被封禁',
                        position: 'right-top'
                    });
                }
            }
            $('#LoginProgress').addClass('mdui-hidden');
            document.getElementById('yzm').src = '/captcha.php?id=' + Math.random();
        }
    });
}

function AgreePro() {
    accpro = true
}

function ChangeTab(t) {

    if (t == "reg") {
        new mdui.Dialog('#ProtocolDialog').open();
        new mdui.Dialog('#RegDialog').open();

    } else {
        new mdui.Dialog('#LoginDialog').open();
    }
}

function ShowAnn(){
    new mdui.Dialog('#AnnDialog').open();
}

function reg() {
    var data = $("#reg").serialize();
    $.ajax({
        type: 'post',
        url: "/ajax.php?fun=reg",
        data: data,
        success: function (json) {
            var array = JSON.parse(json);
            if (array.status) {
                mdui.snackbar({
                    message: '注册成功,三秒后跳转!',
                    position: 'right-top'
                });
                location.reload();
            } else {
                if (array.code == -10) {
                    mdui.snackbar({
                        message: '注册失败,该用户名被注册',
                        position: 'right-top'
                    });
                } else if (array.code == -20) {
                    mdui.snackbar({
                        message: '注册失败,请检查验证码',
                        position: 'right-top'
                    });
                } else if (array.code == -871) {
                    mdui.snackbar({
                        message: 'SYSTEM ALERT: CODE871  您的行为异常',
                        position: 'right-top'
                    });
                } else {
                    mdui.snackbar({
                        message: "注册失败,未知错误!",
                        position: 'right-top'
                    });
                }
            }
            $('#LoginProgress').addClass('mdui-hidden');
            document.getElementById('yzm-reg').src = '/captcha.php?t=reg&id=' + Math.random();
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

function UploadCore(){
    var data = $("#reg").serialize();
}