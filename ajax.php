<?php
include './function.php';

if ($_GET['fun'] == 'logout') {
    $db = new DB('User');
    $_SESSION['ckk'] = 'logout';
    $db->updateData('checkKey', 'logout', array(0 => array('key' => 'id', 'value' => $_SESSION['userID'])));
    $_SESSION['userID'] = 0;
    exit;
}

if ($_GET['fun'] == 'login') {
    $db = new DB('User');
    $data = $db->getData(
        array(
            0 => array(
                'key' => 'username',
                'value' => $_POST['username']
            ),
            1 => array(
                'key' => 'username',
                'value' => md5($_POST['password'])
            )
        )
    );
    if (md5(md5($_POST['captcha'])) != $_SESSION['captcha']) {
        $_SESSION['captcha'] = 'error';
        echo json_encode(
            array(
                'status' => false,
                'code' => -20
            )
        );
        exit;
    }
    if ($data == null || $data == array()) {
        $_SESSION['captcha'] = 'error';
        echo json_encode(
            array(
                'status' => false,
                'code' => -10
            )
        );
        exit;
    } elseif ($data[0]['password'] == md5($_POST['password'])) {
        $_SESSION['ckk'] = md5(md5($_POST['username'] . $_POST['password'] . time()));
        $_SESSION['userID'] = $data[0]['id'];
        $db->updateData('checkKey', md5(md5($_POST['username'] . $_POST['password'] . time())), array(0 => array('key' => 'username', 'value' => $_POST['username'])));
        echo json_encode(
            array(
                'status' => true,
                'code' => 9000
            )
        );
        exit;
    } else {
        echo json_encode(
            array(
                'status' => false,
                'code' => -30
            )
        );
    }
}

if ($_GET['fun'] == 'reg') {
    if ($_POST['accp']!=true){
        echo json_encode(array(
            'status' => false,
            'code' => 281
        ));
        exit;
    }
    $db = new DB('User');
    $data = $db->getData(
        array(
            0 => array(
                'key' => 'username',
                'value' => $_POST['username']
            )
        )
    );
    if ($data != null && $data != array()) {
        echo json_encode(array(
            'status' => false,
            'code' => -10
        ));
        exit;
    }
    $data = array(
        'username' => $_POST['username'],
        'nickname' => $_POST['nickname'],
        'password' => md5($_POST['password']),
        'email' => $_POST['email'],
        'type' => 'user',
        'resiger' => time()
    );
    $db->insertData($data, 'id');
    echo json_encode(array(
        'status' => true
    ));
}

if ($_GET['fun'] == 'user') {
    $db = new DB('User');
    $data = $db->getData(
        array(
            0 => array(
                'key' => 'username',
                'value' => 'kengwang'
            )
        )
    );

    print_r($data);
}
