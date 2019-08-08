<?php
$title='登录';
include './function.php';
if (User::checkLogin()){
    header("Location: /index.php");
}
include 'header.php';