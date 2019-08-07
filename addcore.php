<?php
include_once './function.php';
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
    $des=$_POST['shortdes'];
    $core = array(
        'name' => $name,
        'shortdes'=>$shortdes,
        'des' => $des,
        'type' => $type,
        'uploader' => $uploader,
        'link' => $link
    );
    $db = new DB('Core');
    $db->insertData($core);
    echo 'done';
    exit;
}
?>
<form method="post" action="/addcore.php">
    <input type="text" name="name" id="name">
    <input type="text" name="shortdes" id="shortdes">
    <input type="text" name="des" id="des">
    <input type="text" name="type" id="type">
    <input type="text" name="uploader" id="uploader">
    <input type="text" name="link" id="link">
    <input type="submit" value="提交">
</form>
