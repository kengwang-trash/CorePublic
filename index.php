<?php
$title = '首页';
include './header.php';
?>
<div style="text-align:center; color:#fff; background:none; position:absolute; z-index:20; top:0px; width:100%">
	<div id="bigtitle" class="mdui-container" style="padding-top:64px; padding-bottom:64px;">
		<div class="mdui-typo-display-2 mdui-m-t-3" style="letter-spacing:10px;">核心公开站</div>
		<div class="mdui-typo-headline mdui-m-t-2" style="letter-spacing:2px;"><span class="mdui-text-color-pink">C</span>ore&nbsp;<span class="mdui-text-color-pink">P</span>ublic</div>
		<br />
		<?php
		if ($user::checkLogin()) {
			?>
		<button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent header-btn mdui-color-indigo-700 mdui-m-t-3" mdui-tooltip="{content: '上传前请先同意协议'}">上传</button>

		<?php } else {
			?>
		<button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent header-btn mdui-color-indigo-700 mdui-m-t-3" mdui-dialog="{target:'#LoginDialog'}" mdui-tooltip="{content: '要上传请先登录'}">登录</button>
		<?php
		}
		?><br />
		<br />
		上传文件表示您同意我们的条款
	</div>
</div>


<div class="mdui-m-t-2 mdui-m-b-2 mdui-container" style="max-width:unset;">
	<div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-9">
		<div class="mdui-panel" mdui-panel>
			<div class="mdui-panel-item">
				<div class="mdui-panel-item-header">
					<div class="mdui-panel-item-title">PocketMine系列</div>
					<div class="mdui-panel-item-summary">基于PHP的Minecraft PE/BE 核心</div>
					<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
				</div>
				<div class="mdui-panel-item-body">

				</div>
			</div>
		</div>
	</div>

	<div class="mdui-col-xs-12 mdui-col-sm-4 mdui-col-md-3">
		<div class="mdui-panel" mdui-panel>
			<div class="mdui-panel-item">
				<div class="mdui-panel-item-header">
					<div class="mdui-panel-item-title">
						最近上传
					</div>
					<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
				</div>
				<div class="mdui-panel-item-body">
					<ul class="mdui-list">
						<?php
						$c = $cp->GetRecentUpload();
						if ($c == array()) $c = array(array());
						foreach ($c as $item) {
							echo FP::CoreToListItem($item);
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>

</div>

<!--<div style="height:100vh; width:100%">&nbsp;</div>-->
<?php
include 'footer.php';
?>