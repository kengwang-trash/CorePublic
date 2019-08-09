<?php
$title='最近上传';
include '../header.php';
?>
<!--十个最新 -->
<div class="mdui-panel" mdui-panel>
    <div class="mdui-typo-title">最近十个上传</div>
    <div class="mdui-panel-item">
        <ul class="mdui-list">
            <?php
            $c = $cp->GetRecentUpload();
            if ($c==array()) $c=array(array());
            foreach ($c as $item) {
                echo FP::CoreToListItem($item);
            } 
            ?>
        </ul>
    </div>
</div>