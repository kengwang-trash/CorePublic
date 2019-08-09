<?php
define('ROOT', dirname(__FILE__));
include_once ROOT . '/function.php';
$cp = new CP();
$user = new User();
$userinfo = $user->getUserInfo();
?>
<!DOCTYPE html>
<html>

<head>

	<!--
		Orignal Designed by Kevin 
		Redesign by Kengwang
		Thanks For @Kevin Supporting
		Copyright © 2019 CorePublic
		All rights reserved.
	 -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<link rel="stylesheet" href="/css/mdui.min.css" />
	<title><?php echo $title; ?> - 核心公开站 - CorePublic - 自由,开放,极速的核心公开站</title>


	<script src="/js/mdui.min.js"></script>
	<script src="/js/jquery.min.js"></script>
	<script src="/js/corepublic.js"></script>
	<link rel="stylesheet" href="/css/corepublic.css" />
</head>

<body>
	<?php
	if (!$user::checkLogin()) {
		?>
		<div class="mdui-dialog" id="LoginDialog">
			<div id="LoginProgress" class="mdui-hidden mdui-progress">
				<div class="mdui-progress-indeterminate"></div>
			</div>
			<div class="mdui-tab mdui-tab-full-width" mdui-tab>
				<a href="#LoginTab" class="mdui-ripple">登录</a>
				<a href="#RegTab" class="mdui-ripple">注册</a>
			</div>
			<div class="mdui-dialog-content">
				<div class="mdui-container" id="LoginTab">
					<h1 class="mdui-center">登录到 CorePublic</h1>
					<form id="login">
						<div class="mdui-textfield mdui-textfield-floating-label">
							<div class="mdui-textfield-label">用户名</div>
							<input type="text" name="username" id="username" class="mdui-textfield-input">
						</div>
						<div class="mdui-textfield mdui-textfield-floating-label">
							<div class="mdui-textfield-label">密码</div>
							<input type="password" name="password" id="password" class="mdui-textfield-input">
						</div>
						<div class="mdui-textfield mdui-textfield-floating-label">
							<div class="mdui-textfield-label">验证码</div>
							<input type="text" name="captcha" id="captcha" class="mdui-textfield-input">
							<img id="yzm" src="/captcha.php" onclick="$('#LoginProgress').removeClass('mdui-hidden');this.src='/captcha.php?id='+Math.random()" class="mdui-float-right" style="margin-top: -36px; widht:96px; height:36px;" mdui-tooltip="{content: '点击图片刷新验证码'}" />
						</div>
					</form>
					<br />
					<br />
					<button onclick="$('#LoginProgress').removeClass('mdui-hidden');login()" class="mdui-color-indigo mdui-text-color-white-text mdui-btn-block mdui-center mdui-btn mdui-btn-raised">登录</button>
				</div>

				<!-- Reg -->
				<div class="mdui-container" id="RegTab">
					<h1 class="mdui-center">注册到 CorePublic</h1>
					<form id="reg">
						<div class="mdui-textfield mdui-textfield-floating-label">
							<div class="mdui-textfield-label">用户名</div>
							<input type="text" name="username" id="username" class="mdui-textfield-input">
						</div>
						<div class="mdui-textfield mdui-textfield-floating-label">
							<div class="mdui-textfield-label">昵称</div>
							<input type="text" name="nickname" id="nickname" class="mdui-textfield-input">
						</div>
						<div class="mdui-textfield mdui-textfield-floating-label">
							<div class="mdui-textfield-label">密码</div>
							<input type="password" name="password" id="password" class="mdui-textfield-input">
						</div>
						<div class="mdui-textfield mdui-textfield-floating-label">
							<div class="mdui-textfield-label">邮箱</div>
							<input type="email" name="email" id="email" class="mdui-textfield-input">
						</div>
						<div class="mdui-textfield mdui-textfield-floating-label">
							<div class="mdui-textfield-label">验证码</div>
							<input type="text" name="captcha" id="captcha" class="mdui-textfield-input">
							<img id="yzm" src="/captcha.php?t=reg" onclick="$('#LoginProgress').removeClass('mdui-hidden');this.src='/captcha.php?t=reg&id='+Math.random()" class="mdui-float-right" style="margin-top: -36px; widht:96px; height:36px;" mdui-tooltip="{content: '点击图片刷新验证码'}" />
						</div>
					</form>
					<br />
					<br />
					<button onclick="$('#LoginProgress').removeClass('mdui-hidden');reg();" class="mdui-color-indigo mdui-text-color-white-text mdui-btn-block mdui-center mdui-btn mdui-btn-raised">注册</button>
				</div>
			</div>
		</div>
	<?php
	}
	?>
	<div class="mdui-dialog" id="ProtocolDialog">
		<div class="mdui-dialog-title">协议</div>
		<div class="mdui-dialog-content">
			<div class="mdui-typo">
				首先感谢您使用并支持 核心公开站 - CorePublic 项目(以下简称"该项目"或"本项目"),下面是一些必须遵守的条款(以下简称"本条款"),如果您不同意请关闭此页面!<br>
				1. 该项目不是开源项目,一切对该项目代码的转卖,销售,公开,盗用,修改,篡改等行为都是对于开发者的权利的侵犯!我们必定会追究当事人责任。<br>
				2. 该项目的上传后内容(包括但不限于核心,以下简称"项目内容")无法保证其完全安全,请将要下载或者使用项目内容的人("使用者")谨慎下载,本项目维护人员会尽力保持安全。<br>
				3. 上传内容(包括但不限于核心)的人应当保证上传内容不损害使用者及项目权利和权益,不损害第三方的权利和权益,本项目维护人员有权依据此项条款将上传内容以及上传者冻结。<br>
				4. 在发表言论(包括但不限于
				文件名、文件内容、文件简介、评论)以及文件时请注意遵守当地法律以及"中华人民共和国"法律(包括但不限于《中华人民共和国宪法》),任何违法行为都将受到法律的制裁,本项目人员将会尽力配合执法人员对违法行为追究并冻结其账号!<br>
				5. 在发表言论时请注意言辞,不得发动人身攻击,发布违法中华人民共和国法律的内容(包括但不限于 色情,反动,政治敏感 等),本项目人员将会配合执法人员执法,并且有权利对当事人进行封号及冻结账号处理<br>
				6. 如果您发现本站资源侵犯了您的权利或权益,您有权提出申请,可以将申请发送至<a href="mailto:1136772134@qq.com">1136772134@qq.com</a><br>
				7. 如果有人违反了上述内容或者其他内容,责任将由当事人负责,一切与本项目无关,本项目人员将会协助执法人员执法。<br>
				8. 该协议自2019年8月7日生效,到期时间无限制。<br>
				9. 最终解释权归 核心公开站 - CorePublic 项目 开发人员所有!<br>
				<br>
				核心公开站 - CorePublic 项目组<br>
				2019年8月7日<br>
			</div>
		</div>
		<div class="mdui-dialog-actions">
			<button class="mdui-btn mdui-ripple" onclick="closePage();">我不同意</button>
			<button class="mdui-btn mdui-ripple" mdui-dialog-close>我已阅读并同意</button>
		</div>
	</div>

	<div id="nav" class="nav mdui-appbar mdui-appbar-fixed mdui-shadow-0">
		<div class="mdui-toolbar">
			<i class="mdui-icon material-icons"> </i>
			<a href="">
				<div id="main-title" class="mdui-typo-headline">核心公开站</div>
			</a>
			<div id="sub-title" class="mdui-typo-title"><?php echo $title; ?></div>
			<div class="mdui-toolbar-spacer"></div>
			<?php
			if (!$user::checkLogin()) {
				?>
				<button mdui-dialog="{target:'#LoginDialog'}" class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-theme-accent mdui-ripple">登录</button>
			<?php } else {
				if (!isset($userinfo['avatar'])) {
					$email = $userinfo['email'];
					$default = "mm";
					$size = 40;
					$grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
					?><a class="mdui-btn" style="text-transform: unset !important;"><img class="mdui-icon" src="<?php echo $grav_url; ?>">&nbsp;&nbsp;<span><?php echo $userinfo['username']; ?></span></a>
				<?php }
			} ?>
			<a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#menu'}"><i class="mdui-icon material-icons">more_vert</i></a>
			<ul class="mdui-menu" id="menu">
				<li class="mdui-menu-item">
					<a mdui-dialog="{target:'#ProtocolDialog'}" class="mdui-ripple">查看协议</a>
				</li>
				<li class="mdui-menu-item">
					<a href="/about.php" class="mdui-ripple">关于我们</a>
				</li>
			</ul>
		</div>
	</div>

	<div id="header">&nbsp;</div>
	<!-- Header End -->
	<?php if ($title != '首页') {
		echo '<div class="mdui-container" id="BodyContents">';
	} else {
		echo '	<div id="header" class="wrapper mdui-shadow-1">
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>';
	}
