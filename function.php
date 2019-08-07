<?php
include_once('./config.php');
define('DEV', true);

class User
{
    private static $userID;
    public function __construct()
    {
        if (!checkLogin() && !DEV){
            return false;
        }
    }
    public static function checkLogin()
    {
        if (isset($_COOKIE['userID']) || $_COOKIE['userID'] != 0) {
            self::$userID = $_COOKIE['userID'];
            if (getUserInfo()['checkKey'] == $_COOKIE['ckk']) {
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
    public function getUserInfo($userID=null)
    {
        if ($userID==null){
            $userID=self::$userID;
        }
        $db = new DB('User');
        return $db->getData()[$userID];
    }
}
class CP
{
    private static $config;
    public function __construct()
    {
        global $conf;
        self::$config=$conf;
    }
    public function GetRecentUpload($num = 15)
    {
        $db = new DB('Upload', 'json', self::$config['database']['link']);
        $datas = $db->getData(array(), $num);
        return $datas;
    }
}
class ErrorHandler
{
    public function Error($msg, $level)
    { }
}
class DB
{
    private static $url;
    private static $datas;
    public function __construct($database, $dbtype = 'json', $dblink = './data/database/')
    {
        if ($dbtype == 'json') {
            self::$url = $dblink . '/' . $database . '.json';
            $json = file_get_contents(self::$url);
            $json=self::StrEncrypt($json,'DECODE');
            self::$datas = json_decode($json, true);
        } else {
            echo 'Unsupport Database Type ' . $dbtype;
        }
    }
    public function getData($where = array(), $limit = -1, $sortby = 'none')
    {
        $result = self::$datas;

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
        if ($limit != -1) $result = array_slice($result,0, $limit - 1);
        return $result;
    }

    public function insertData($data)
    {
        self::$datas[] = $data;
        self::SaveDataByDatas();
    }

    private function SaveDataByDatas()
    {
        $json = json_encode(self::$datas);
        $json=self::StrEncrypt($json,'ENCODE');
        file_put_contents(self::$url, $json);
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
        if ($string==''){
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
