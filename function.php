<?php
session_start();
define('ROOT', dirname(__FILE__));
include_once(ROOT . '/config.php');
define('DEV', false);

class User
{
    private static $userID;
    public function __construct()
    {
        self::$userID = $_SESSION['userID'];
    }
    public static function checkLogin()
    {
        if (isset($_SESSION['userID']) && $_SESSION['userID'] != 0) {
            self::$userID = $_SESSION['userID'];
            if (self::getUserInfo()['checkKey'] == $_SESSION['ckk']) {
                return true;
            } else {
                return false;
            }
        } else {
            self::$userID = -1;
            return false;
        }
        return false;
    }
    public static function getUserInfo($userID = null)
    {
        if ($userID == null) {
            $userID = self::$userID;
        }
        $db = new DB('User');
        return $db->getData(array())[$userID];
    }
}
class CP
{
    private static $config;
    public function __construct()
    {
        global $conf;
        self::$config = $conf;
    }
    public function GetRecentUpload($num = 15)
    {
        $db = new DB('Core', 'json');
        $datas = $db->getData(array(), $num);
        return $datas;
    }
}

class Core
{
    public function AddCore($core)
    {
        $db = new DB('Core');
        $db->insertData($core, 'id');
    }
}

class ErrorHandler
{
    public function Error($msg, $level)
    { }
}

class FP
{ //前端解析类
    public static function CoreToListItem($Core)
    {
        $notavalable = false;
        if ($Core == array()) {
            $notavalable = true;
            $Core = array(
                'id' => 0,
                'name' => '当前还没有核心哦',
                'shortdes' => '快来上传第一个吧!',
                'uploader' => -50,
                'version' => '暂无',
                'uploadtime' => 'Today',
                'updatetime' => 'Today'
            );
        }
        $r = '';
        switch ($Core['type']) {
            case 'PHP5':
                $typeout = 'PE核心 PHP5';
                $icon = 'phone_android';
                break;
            case 'PHP7':
                $typeout = 'PE核心 PHP7';
                $icon = 'phone_android';
                break;
            case 'PHP72':
                $typeout = 'PE核心 PHP7.2';
                $icon = 'phone_android';
                break;
            case 'JAVA-PC':
                $typeout = 'PC核心';
                $icon = 'desktop_windows';
                break;
            case 'JAVA-NK':
                $typeout = 'PE核心 JAVA';
                $icon = 'phone_android';
                break;
            default:
                $typeout = '未知核心';
                $icon = 'bubble_chart';
                break;
        }
        $r = '
    <!--<a href="/core.php?id=' . $Core['id'] . '"> -->
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons" mdui-tooltip="{content: \'' . $typeout . '\'}">' . $icon . '</i>
            <div class="mdui-list-item-content">
                <div class="mdui-list-item-title mdui-list-item-one-line">
                    ' . $Core['name'] . '
                    <div class="mdui-typo-subheading-opacity">' . $Core['version'] . '
                    </div>
                </div>
                <div class="mdui-list-item-text mdui-list-item-one-line">' . $Core['shortdes'] . '</div>
                <div class="mdui-list-item-text mdui-list-item-one-line"><i class="mdui-icon material-icons">account_circle</i>上传者:' . User::getUserInfo($Core['uploader'])['nickname'] . '&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdui-icon material-icons">assessment</i>版本:&nbsp;' . $Core['version'] . '</div>
            </div>
            <a class="mdui-hidden-lg-down" href="/down.php?id=' . $Core['id'] . '"><button class="mdui-hidden-sm-down mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">cloud_download</i>&nbsp;下载</button></a>
            <a class="mdui-hidden-xl" href="/down.php?id=' . $Core['id'] . '"><button class="mdui-hidden-sm-up mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">cloud_download</i></button></a>
        </li>
    <!-- </a> -->';
        return $r;
    }
}

class DB
{
    private static $url;
    private static $datas;
    public function __construct($database, $dbtype = 'json', $dblink = ROOT . '/data/database/')
    {
        if ($dbtype == 'json') {
            self::$url = $dblink . '/' . $database . '.json';
            $json = file_read_safe(self::$url);
            $json = self::StrEncrypt($json, 'DECODE');
            if ($json == '') {
                self::$datas = array();
            } else {
                self::$datas = json_decode($json, true);
            }
        } else {
            echo 'Unsupport Database Type ' . $dbtype;
        }
    }

    public function updateData($key, $value, $where = array())
    {
        $result = self::$datas;
        if (!$where == array() && count($where) > 0) {
            $realres = array();
            foreach ($where as $search) {
                //遍历搜寻法
                foreach ($result as $k => $r) {
                    if ($r[$search['key']] == $search['value']) {
                        $r[$key] = $value;
                        $result[$k] = $r;
                    }
                }
            }
        }
        self::$datas = $result;
        self::SaveDataByDatas();
    }


    public function getData($where = array(), $limit = -1, $sortby = 'none', $offset = 0)
    {
        $result = self::$datas;
        if ($result == array()) {
            return $result;
        }
        if (!$where == array() && count($where) > 0) {
            $realres = array();
            foreach ($where as $search) {
                //遍历搜寻法
                foreach ($result as $r) {
                    if ($r[$search['key']] == $search['value']) {
                        if (!in_array($r, $realres)) $realres[] = $r;
                    }
                }
            }
            $result = $realres;
        }

        if ($sortby != 'none') $result = self::SortArray($result, $sortby);
        if ($limit != -1) $result = array_slice($result, $offset, $limit - 1);
        return $result;
    }

    public function insertData($data, $autoaddkey = '')
    {
        $nowid = count(self::$datas) + 1;
        if ($autoaddkey != '') {
            $data[$autoaddkey] = $nowid;
        }
        self::$datas[$nowid] = $data;
        self::SaveDataByDatas();
        return $nowid;
    }

    private function SaveDataByDatas()
    {
        $json = json_encode(self::$datas);
        $json = self::StrEncrypt($json, 'ENCODE');
        file_write_safe(self::$url, $json);
    }
    private static function SortArray($data, $sort_order_field, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
    {
        foreach ($data as $val) {
            $key_arrays[] = $val[$sort_order_field];
        }
        array_multisort($key_arrays, SORT_ASC, SORT_NUMERIC, $data);
        return $data;
    }

    /**
     * 文本加密函数
     * @param string $string 原文或者密文
     * @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE
     * @param string $key 密钥
     * @param int $expiry 密文有效期, 加密时候有效， 单位 秒，0 为永久有效
     * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
     *
     * @example
     *
     *  $a = authcode('abc', 'ENCODE', 'key');
     *  $b = authcode($a, 'DECODE', 'key');  // $b(abc)
     *
     *  $a = authcode('abc', 'ENCODE', 'key', 3600);
     *  $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
     */
    private static function StrEncrypt($string, $operation = 'DECODE', $key = 'HGay1*ji/aDn#l?57Gai', $expiry = 0)
    {
        if ($string == '') {
            return '';
        }
        $ckey_length = 4;
        // 随机密钥长度 取值 0-32;
        // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
        // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
        // 当此值为 0 时，则不产生随机密钥

        $key = md5($key ? $key : 'HGay1*ji/aDn#l?57Gai'); //这里可以填写默认key值
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }
}


/**
 * @link http://kodcloud.com/
 * @author warlee | e-mail:kodcloud@qq.com
 * @copyright warlee 2014.(Shanghai)Co.,Ltd
 * @license http://kodcloud.com/tools/license/license.txt
 */


/**
 * 安全读取文件，避免并发下读取数据为空
 * 
 * @param $file 要读取的文件路径
 * @param $timeout 读取超时时间 
 * @return 读取到的文件内容 | false - 读取失败
 */
function file_read_safe($file, $timeout = 5)
{
    if (!$file || !file_exists($file)) return false;
    $fp = @fopen($file, 'r');
    if (!$fp) return false;
    $startTime = microtime(true);

    // 在指定时间内完成对文件的独占锁定
    do {
        $locked = flock($fp, LOCK_EX | LOCK_NB);
        if (!$locked) {
            usleep(mt_rand(1, 50) * 1000);     // 随机等待1~50ms再试
        }
    } while ((!$locked) && ((microtime(true) - $startTime) < $timeout));

    if ($locked && filesize($file) >= 0) {
        $result = @fread($fp, filesize($file));
        flock($fp, LOCK_UN);
        fclose($fp);
        if (filesize($file) == 0) {
            return '';
        }
        return $result;
    } else {
        flock($fp, LOCK_UN);
        fclose($fp);
        return false;
    }
}

/**
 * 安全写文件，避免并发下写入数据为空
 * 
 * @param $file 要写入的文件路径
 * @param $buffer 要写入的文件二进制流（文件内容）
 * @param $timeout 写入超时时间 
 * @return 写入的字符数 | false - 写入失败
 */
function file_write_safe($file, $buffer, $timeout = 5)
{
    clearstatcache();
    if (strlen($file) == 0 || !$file) return false;

    // 文件不存在则创建
    if (!file_exists($file)) {
        @file_put_contents($file, '');
    }
    if (!is_writeable($file)) return false;    // 不可写

    // 在指定时间内完成对文件的独占锁定
    $fp = fopen($file, 'r+');
    $startTime = microtime(true);
    do {
        $locked = flock($fp, LOCK_EX);
        if (!$locked) {
            usleep(mt_rand(1, 50) * 1000);   // 随机等待1~50ms再试
        }
    } while ((!$locked) && ((microtime(true) - $startTime) < $timeout));

    if ($locked) {
        $tempFile = $file . '.temp';
        $result = file_put_contents($tempFile, $buffer, LOCK_EX);

        if (!$result || !file_exists($tempFile)) {
            flock($fp, LOCK_UN);
            fclose($fp);
            return false;
        }
        @unlink($tempFile);

        ftruncate($fp, 0);
        rewind($fp);
        $result = fwrite($fp, $buffer);
        flock($fp, LOCK_UN);
        fclose($fp);
        clearstatcache();
        return $result;
    } else {
        flock($fp, LOCK_UN);
        fclose($fp);
        return false;
    }
}
