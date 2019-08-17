<?php
$title = '查看核心';
include './header.php';
$db = new DB('Core');
$data = $db->getData(array(0 => array('key' => 'id', 'value' => $_GET['id'])));
print_r($data);