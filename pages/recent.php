<?php
include '../header.php';
?>
<!--十个最新 -->
<div class="mdui-panel" mdui-panel>
    <div class="mdui-typo-title">最近十个上传</div>
    <div class="mdui-panel-item">
        <ul class="mdui-list">
            <?php
            $c = $cp->GetRecentUpload();
            if ($c == array()) {
                $c[] = array(
                    'id' => 0,
                    'name' => '当前还没有核心哦',
                    'shortdes' => '快来上传第一个吧!'
                );
            }
            foreach ($c as $item) {
                echo FP::CoreToListItem($item);
            } ?>
        </ul>
    </div>
</div>