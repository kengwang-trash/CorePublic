<?php
include './function.php';
if ($_POST['fun'] == 'login') {
    $db = new DB('User');
    $data = $db->getData(
        array(
            0 => array(
                'key' => 'username',
                'value' => $_POST['username']
            )
        )
    );
    var_dump($data);
}

if ($_POST['fun'] == 'reg') {
    $db = new DB('User');
    $data = array(
        'username' => $_POST['username'],
        'password' => md5($_POST['password']),
        'email' => $_POST['email'],
        'resiger' => time()
    );
    $db->insertData($data,'id');
}
