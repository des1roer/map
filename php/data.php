<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/database.php';

//db properties
define('DB_TYPE', 'pgsql');
define('DB_HOST', 'localhost');
define('DB_USER', 'postgres');
define('DB_PASS', 'postgres');
define('DB_NAME', 'postgres');
define('DB_TABLE', 'data');
define('DB_PORT', '5432');
define('PKEY', 'id');

// make a connection to mysql here
$db = Database::get();

date_default_timezone_set('Asia/Yekaterinburg');

if (empty($_REQUEST['act'])) die('no action');
$act = $_REQUEST['act'];
$db->exec('SET search_path TO public');

switch ($act) {
    case 'load':
        echo json_encode($db->select('id, name,season,series,url from data'));
        break;
    case 'add':
        try {
            $id = $db->insert(DB_TABLE, $_POST['data']);
            echo json_encode(array($id));
        } catch (PDOException $e) {
            echo json_encode(array('error' => $e));
        }
        break;
    case 'edit':
        try {
            $_POST['data']=array_map('trim',$_POST['data']);
            $where = array(PKEY => $_POST['data']['id']);            
            $id = $db->update(DB_TABLE, $_POST['data'], $where);
            echo json_encode(array($id));
        } catch (PDOException $e) {
            echo json_encode(array('error' => $e));
        }
        break;
    case 'del':
        try {
            $where = array(PKEY => $_POST['data']['id']);
            $id = $db->delete(DB_TABLE, $where);
            echo json_encode(array($id));
        } catch (PDOException $e) {
            echo json_encode(array('error' => $e));
        }
        break;
    default :
        break;
}

