<?php
include './function.php';

function ThrowError($code, $msg = "")
{
    echo json_encode(array(
        'status' => false,
        'code' => $code,
        'msg' => $msg
    ));
    exit;
}

function ThrowDone($code = 9000, $msg = "")
{
    echo json_encode(array(
        'status' => true,
        'code' => $code,
        'msg' => $msg
    ));
    exit;
}

//操作类

if (isset($_GET['fun'])) {
    $x = $_GET['fun'];
    if (function_exists(Ajax::$x())) {
        Ajax::$x();
    }else{
        ThrowError(-300,'Function '.$x.' Not Defined!');
    }
}
class Ajax
{
    public static function logout()
    {
        $db = new DB('User');
        $_SESSION['ckk'] = 'logout';
        $db->updateData('checkKey', 'logout', array(0 => array('key' => 'id', 'value' => $_SESSION['userID'])));
        $_SESSION['userID'] = 0;
        ThrowDone();
        exit;
    }

    public static function Login()
    {
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
        if ($data[0]['tryNum'] == 5) {
            /*
        $db->updateData('ban', true, array(
            0 => array(
                'key' => 'username',
                'value' => $_POST['username']
            )
        ));
        */ }

        if ($data[0]['ban'] == true) {
            ThrowError(-871, 'SYSTEM ALERT: CODE871  您的账号被封禁');
        }

        if (md5(md5($_POST['captcha'])) != $_SESSION['captcha']) {
            $_SESSION['captcha'] = 'error';
            ThrowError(-20, "验证码错误");
            exit;
        }
        if ($data == null || $data == array()) {
            $_SESSION['captcha'] = 'error';
            ThrowError(-10, "用户名或密码不正确");
            exit;
        } elseif ($data[0]['password'] == md5($_POST['password'])) {
            $_SESSION['ckk'] = md5(md5($_POST['username'] . $_POST['password'] . time()));
            $_SESSION['userID'] = $data[0]['id'];
            $db->updateData('checkKey', md5(md5($_POST['username'] . $_POST['password'] . time())), array(0 => array('key' => 'username', 'value' => $_POST['username'])));
            ThrowDone();
            exit;
        } else {
            $_SESSION['captcha'] = 'error';
            @$nowtry = $data[0]['tryNum'] + 1;
            $db->updateData('tryNum', $nowtry, array(
                'key' => 'username',
                'value' => $_POST['username']
            ));
            ThrowError(-10, "密码错误,还有" . (5 - $nowtry) . '次机会');
        }
    }

    public static function reg()
    {
        if ($_POST['accp'] != true) {
            ThrowError(-871, 'SYSTEM ALERT: CODE871  您的行为异常');
            exit;
        }
        if (md5(md5($_POST['captcha'])) != $_SESSION['captreg']) {
            $_SESSION['captreg'] = 'error';
            ThrowError(-20, "验证码错误");
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
            $_SESSION['captreg'] = 'error';
            ThrowError(-10, "该用户名已被注册");
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
        ThrowDone();
    }

    public static function UserShow()
    {
        $db = new DB('User');
        $data = $db->getData();

        print_r($data);
    }

    public static function ReshowAnn()
    {
        $_SESSION['WatchAnn'] = false;
    }

    public static function ShowCores()
    {
        $db = new DB('Core');
        $data = $db->getData();
        print_r($data);
    }


    public static function addcore()
    {
        if (!User::checkLogin()) { }
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $des = $_POST['des'];
            $type = $_POST['type'];
            $uploader = $_SESSION['userID'];
            $link = $_POST['link'];
            $shortdes = $_POST['shortdes'];
            $cdata = array(
                'name' => $name,
                'shortdes' => $shortdes,
                'des' => $des,
                'type' => $type,
                'uploader' => $uploader,                
                'link' => $link,
                'uploadtime' => time()
            );
            $core=new Core();
            $core->AddCore($cdata);
            ThrowDone();
            exit;
        }
    }
}
