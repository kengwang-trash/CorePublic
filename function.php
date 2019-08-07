<?php
include_once('./config.php');
class CP
{
    public $user;
    private $config = $conf;
    public function __construct()
    { }
    public function GetRecentUpload($num = 15)
    {
        $db = new DB('Upload', self::$config['database']['type'], self::$config['database']['link']);
        $datas = $db->getData('Cores', array(), $num);
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
    private $url;
    private $datas;
    public function __construct($database, $dbtype, $dblink = './data/database/')
    {
        if ($dbtype == 'json') {
            self::$url=$dblink . '/' . $database;
            $json = file_get_contents(self::$url);
            self::$datas = json_decode($json, true);
        } else {
            echo 'Unsupport Database Type ' . $dbtype;
        }
    }
    public function getData($field, $where = array(), $limit = -1)
    {
        $result = self::$datas[$field];
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
        if ($limit != -1) $result = array_slice($result, $limit - 1);
        return $result;
    }

    public function insertData($data)
    {
        self::$datas[]=$data;
    }
    private function SaveDataByDatas(){
        $json=json_encode(self::$datas);
        file_put_contents($);
    }
}
