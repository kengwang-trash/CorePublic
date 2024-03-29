<?php
$title = '添加核心';
$NeedMD = true;
include_once '../header.php';
?>
<div class="mdui-typo-display-2 mdui-center mdui-container">添加核心</div>
<form method="post" style="width:100%" action="/ajax.php?fun=addcore">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">插件名称</label>
        <input class="mdui-textfield-input" type="text" name="name" id="name">
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">一句话简介</label>
        <input class="mdui-textfield-input" type="text" name="shortdes" id="shortdes">
    </div>
    <div id="editor">
        <textarea name="des" style="display:none;"></textarea>
    </div>
    <select class="mdui-select" mdui-select name="type" id="type">
        <optgroup label="Java系列">
            <option value="JAVA-PC">PC</option>
            <option value="JAVA-NK">Nukkit</option>
        </optgroup>
        <optgroup label="PHP系列">
            <option value="PHP5">PM-PHP5</option>
            <option value="PHP7">PM-PHP7</option>
            <option value="PHP72">PM-PHP7.2</option>
        </optgroup>
    </select>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">下载链接,后期替换为上传</label>
        <input class="mdui-textfield-input" type="text" name="link" id="link">
    </div>
    <button class="mdui-btn mdui-btn-block mdui-btn-raised mdui-color-indigo mdui-ripple">上传</button>
    </form>
    
<br>
<br>

<br>
<br>
<?php
include '../footer.php';
