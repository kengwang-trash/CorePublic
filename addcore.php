<?php
include_once './header.php';
if (!User::checkLogin()) {
    //Need Logins
    exit;
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $des = $_POST['des'];
    $type = $_POST['type'];
    $uploader = $_COOKIE['userID'];
    $link = $_POST['link'];
    $des = $_POST['shortdes'];
    $core = array(
        'name' => $name,
        'shortdes' => $shortdes,
        'des' => $des,
        'type' => $type,
        'uploader' => $uploader,
        'link' => $link,
        'uploadtime' => time()
    );
    $db = new DB('Core');
    $db->insertData($core);
    echo 'done';
    exit;
}
?>

<form method="post" action="/addcore.php">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">插件名称</label>
        <input type="text" name="name" id="name">
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">一句话简介</label>
        <input class="mdui-textfield-input" type="text" name="shortdes" id="shortdes">
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">核心简介(可多行)</label>
        <input class="mdui-textfield-input" type="text" name="des" id="des">
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">核心简介(可多行)</label>
        <input class="mdui-textfield-input" type="text" name="type" id="type">
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
        <label class="mdui-textfield-label">Email</label>
        <input class="mdui-textfield-input" type="text" name="link" id="link">
    </div>
    <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" type="submit">提交</button>
</form>