<?php
include_once 'header.php';
?>

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

		<?php
		if ($item['type']=='PC'){
			echo '<i class="mdui-list-item-icon mdui-icon material-icons">desktop_windows</i>';
		}elseif ($item['type']=='PE') {
			echo '<i class="mdui-list-item-icon mdui-icon material-icons">phone_android</i>';
		}else{
			echo '<i class="mdui-list-item-icon"></i>';
		}
		?>
	</i>
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

	
<?php
include 'footer.php';
?>