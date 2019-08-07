<?php
include_once './function.php';
if (!User::checkLogin()){
    //Need Logins
    exit;
}
$name=$_POST['name'];
$des=$_POST['des'];
$type=$_POST['type'];
$uploader=$_COOKIE['userID'];
$link=$_POST['link'];
$core=array(
    'name'=>$name,
    'des'=>$des,
    'type'=>$type,
    'uploader'=>$uploader,
    'link'=>$link
);
$db=new DB('Core');
$db->insertData($core);
echo 'done';