<?php 
include_once './function.php';
$cp=new CP();
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
	<link rel="stylesheet" href="css/mdui.min.css" />
	<title>核心公开站 - CorePublic - 自由,开放,极速的核心公开站</title>
	<style type="text/css">
		.nav {
			position: fixed;
			color: #fff;
		}

		.c {
			animation: myfirst 0s;
			-webkit-animation: myfirst 0s;
			animation-fill-mode: forwards;
		}

		@keyframes myfirst {
			from {}

			to {
				background: rgba(63, 81, 181, 1);
			}
		}

		@-webkit-keyframes myfirst

		/* Safari and Chrome */
			{
			from {}

			to {
				background: rgba(63, 81, 181, 1);
			}
		}



		.ac {
			animation: acac 0s;
			-webkit-animation: acac 0 s;
			animation-fill-mode: forwards;
		}

		@keyframes acac {
			from {
				background: rgba(63, 81, 181, 1);
			}

			to {}
		}

		@-webkit-keyframes acac

		/* Safari and Chrome */
			{
			from {
				background: rgba(63, 81, 181, 1);
			}

			to {}
		}


		.aa {
			background: rgba(63, 81, 181, 0);
		}

		.bb {
			background: rgba(63, 81, 181, 1);
		}


		.j {
			padding: 10px;
		}

		.shadow {
			box-shadow: 1px 1px 5px #1A237E;
		}

		.content {
			position: fixed;
			top: 0;
			right: 0;
			left: 0;
			bottom: 2.5rem;
		}

		.overflow-hidden::-webkit-scrollbar {
			width: 0px;
			height: 0px;
		}


		.footer a {
			text-decoration: none;
			color: #fff;
			opacity: 0.9;
		}


		.wrapper {
			background-image: linear-gradient(75deg, #3f51b5 20%, #3949ab 80%);
			position: absolute;
			top: 0;
			width: 100%;
			overflow: hidden;
		}

		.bg-bubbles {
			position: absolute;
			width: 100%;
			height: 100%;
			z-index: 5;
		}

		.bg-bubbles li {
			position: absolute;
			list-style: none;
			display: block;
			width: 40px;
			height: 40px;
			background-color: rgba(255, 255, 255, 0.15);
			bottom: -150px;
			-webkit-animation: square 25s infinite;
			animation: square 25s infinite;
			-webkit-transition-timing-function: linear;
			transition-timing-function: linear;
		}

		.bg-bubbles li:nth-child(1) {
			left: 10%;
		}

		.bg-bubbles li:nth-child(2) {
			left: 20%;
			width: 80px;
			height: 80px;
			-webkit-animation-delay: 2s;
			animation-delay: 2s;
			-webkit-animation-duration: 17s;
			animation-duration: 17s;
		}

		.bg-bubbles li:nth-child(3) {
			left: 25%;
			-webkit-animation-delay: 4s;
			animation-delay: 4s;
		}

		.bg-bubbles li:nth-child(4) {
			left: 40%;
			width: 60px;
			height: 60px;
			-webkit-animation-duration: 22s;
			animation-duration: 22s;
			background-color: rgba(255, 255, 255, 0.25);
		}

		.bg-bubbles li:nth-child(5) {
			left: 70%;
		}

		.bg-bubbles li:nth-child(6) {
			left: 80%;
			width: 120px;
			height: 120px;
			-webkit-animation-delay: 3s;
			animation-delay: 3s;
			background-color: rgba(255, 255, 255, 0.2);
		}

		.bg-bubbles li:nth-child(7) {
			left: 32%;
			width: 160px;
			height: 160px;
			-webkit-animation-delay: 7s;
			animation-delay: 7s;
		}

		.bg-bubbles li:nth-child(8) {
			left: 55%;
			width: 20px;
			height: 20px;
			-webkit-animation-delay: 15s;
			animation-delay: 15s;
			-webkit-animation-duration: 40s;
			animation-duration: 40s;
		}

		.bg-bubbles li:nth-child(9) {
			left: 25%;
			width: 10px;
			height: 10px;
			-webkit-animation-delay: 2s;
			animation-delay: 2s;
			-webkit-animation-duration: 40s;
			animation-duration: 40s;
			background-color: rgba(255, 255, 255, 0.3);
		}

		.bg-bubbles li:nth-child(10) {
			left: 90%;
			width: 160px;
			height: 160px;
			-webkit-animation-delay: 11s;
			animation-delay: 11s;
		}

		@-webkit-keyframes square {
			0% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
			}

			100% {
				-webkit-transform: translateY(-700px) rotate(600deg);
				transform: translateY(-700px) rotate(600deg);
			}
		}

		@keyframes square {
			0% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
			}

			100% {
				-webkit-transform: translateY(-700px) rotate(600deg);
				transform: translateY(-700px) rotate(600deg);
			}
		}

		.header-btn {
			border: 2px solid #7986cb;
			border-radius: 100px;
			opacity: 0.45;
			min-width: 120px;
		}

		.header-btn:hover {
			opacity: 1;
			border: 2px solid #9fa8da;
		}
	</style>
</head>

<body>

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
			<div id="main-title" class="mdui-typo-headline">核心公开站</div>
			<div id="sub-title" class="mdui-typo-title">CorePublic</div>
			<div class="mdui-toolbar-spacer"></div>
			<button class="mdui-btn mdui-btn-raised mdui-btn-dense mdui-color-theme-accent mdui-ripple">登录</button>
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

	<div id="header" class="wrapper mdui-shadow-1">
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
	</div>

	<div style="text-align:center; color:#fff; background:none; position:absolute; z-index:20; top:0px; width:100%">
		<div id="bigtitle" class="mdui-container" style="padding-top:64px; padding-bottom:64px;">
			<div class="mdui-typo-display-1 mdui-m-t-3" style="letter-spacing:10px;">核心公开站</div>
			<div class="mdui-typo-headline mdui-m-t-2" style="letter-spacing:2px;"><span class="mdui-text-color-pink">C</span>ore&nbsp;<span class="mdui-text-color-pink">P</span>ublic</div>
			<br />
			<button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent header-btn mdui-color-indigo-700 mdui-m-t-3" mdui-tooltip="{content: '上传前请先同意协议'}">上传</button>
			<br />
			<br />
			<label class="mdui-checkbox">
				<input type="checkbox" id="accp" />
				<i class="mdui-checkbox-icon"></i>
				<a mdui-dialog="{target: '#ProtocolDialog'}">勾选表示您已阅读并且愿意遵守使用协议</a>
			</label>
		</div>
	</div>

	<div class="mdui-m-t-2 mdui-m-b-2 mdui-container">
		<div class="mdui-col-xs-12 mdui-col-sm-4 mdui-col-md-3">
			div1
		</div>

		<div class="mdui-col-xs-12 mdui-col-sm-4 mdui-col-md-6">
			<!--十个最新 -->
<div class="mdui-panel" mdui-panel>
<div class="mdui-panel-item">
	<ul class="mdui-list">
		<?php
		$c=$cp->GetRecentUpload();		
		foreach ($c as $item){?>
	<li class="mdui-list-item mdui-ripple">
    <i class="mdui-list-item-icon mdui-icon material-icons">move_to_inbox</i>
    <div class="mdui-list-item-content"><?php echo $item['name'] ?></div>
  </li>
		<?php } ?>
	</ul>
</div>
</div>
		</div>

		<div class="mdui-col-xs-12 mdui-col-sm-4 mdui-col-md-3">
			div3
		</div>

	</div>

	<!--<div style="height:100vh; width:100%">&nbsp;</div> 占位 -->

	<div class="mdui-color-grey-700 mdui-p-t-4">
		<div class="mdui-container footer">

			<div class="mdui-col-xs-6 mdui-col-sm-6 mdui-col-md-3 mdui-m-t-1 mdui-m-b-1">
				<div class="mdui-typo-subheading-opacity">信息栏1</div>
				<ul>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
				</ul>
			</div>

			<div class="mdui-col-xs-6 mdui-col-sm-6 mdui-col-md-3 mdui-m-t-1 mdui-m-b-1">
				<div class="mdui-typo-subheading-opacity">信息栏2</div>
				<ul>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
				</ul>
			</div>


			<div class="mdui-col-xs-6 mdui-col-sm-6 mdui-col-md-3 mdui-m-t-1 mdui-m-b-1">
				<div class="mdui-typo-subheading-opacity">信息栏3</div>
				<ul>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
					<a href="#">
						<li># 链接</li>
					</a>
				</ul>
			</div>


			<div class="mdui-col-xs-6 mdui-col-sm-6 mdui-col-md-3 mdui-m-t-1 mdui-m-b-1">
				<div class="mdui-typo-subheading-opacity">信息栏4</div>
				<br>
				<div class="mdui-col-xs-12" style="word-wrap:break-word; word-break:normal;">
					###############################################
				</div>
			</div>

		</div>
		<br>
		<div class="mdui-container" style="text-align:center">
			<div class="mdui-divider-light"></div>
			<div class="mdui-p-t-3 mdui-p-b-3" style="opacity:0.68">
				Copyright&nbsp;&nbsp;By&nbsp;&nbsp;©&nbsp;&nbsp;CorePublic&nbsp;&nbsp;All&nbsp;&nbsp;rights&nbsp;&nbsp;reserved.
			</div>
		</div>
	</div>


	<script src="js/mdui.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script>
		var $jb_back = $('#jb').outerHeight();

		$('.jb').height($)

		var $nav_height = $("#nav").outerHeight();

		var $bigtitle = $('#bigtitle').outerHeight();

		$('.wrapper').height($bigtitle);

		$("#header").height($bigtitle);

		function _scroll() {
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
		$(window).on('scroll', function() {
			_scroll()
		});
		$(document).ready(function() {
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
			}
			alert('请手动关闭本标签页');

		}
	</script>
</body>

</html>