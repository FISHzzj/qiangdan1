<?php
defined('IN_IA') or exit('Access Denied');

$config = array();

$config['db']['host'] = '127.0.0.1';
$config['db']['username'] = 'qiangdan3_iiio_';
$config['db']['database'] = 'qiangdan3_iiio_';
$config['db']['password'] = 'yyAPZhkRPQKm7ka8';
$config['db']['port'] = '3306';
$config['db']['charset'] = 'utf8';
$config['db']['pconnect'] = 0;
$config['db']['tablepre'] = 'ims_';

// --------------------------  CONFIG COOKIE  --------------------------- //
$config['cookie']['pre'] = '57da_';
$config['cookie']['domain'] = '';
$config['cookie']['path'] = '/';

// --------------------------  CONFIG SETTING  --------------------------- //
$config['setting']['charset'] = 'utf-8';
$config['setting']['cache'] = 'mysql';
$config['setting']['timezone'] = 'Asia/Shanghai';
$config['setting']['memory_limit'] = '256M';
$config['setting']['filemode'] = 0644;
$config['setting']['authkey'] = '1e61ba97';
$config['setting']['founder'] = '1';
$config['setting']['development'] = 0;#默认为开发者模式1
$config['setting']['referrer'] = 0;
//wx_shop redis前缀
$config['setting']['site']=['key'=>'111111'];

// --------------------------  CONFIG UPLOAD  --------------------------- //
$config['upload']['image']['extentions'] = array('gif', 'jpg', 'jpeg', 'png');
$config['upload']['image']['limit'] = 5000;
$config['upload']['attachdir'] = 'attachment';
$config['upload']['audio']['extentions'] = array('mp3');
$config['upload']['audio']['limit'] = 5000;

// --------------------------  HTTPS UP  --------------------------- //
$config['setting']['https'] = 0;

$config['setting']['redis']['server'] = '127.0.0.1'; 
$config['setting']['redis']['port'] = 6379; 
$config['setting']['redis']['pconnect'] = 0; 
$config['setting']['redis']['requirepass'] = ''; 
$config['setting']['redis']['timeout'] = 1;


$config['socketio']="http://".$_SERVER['SERVER_NAME'].":7322";
$config['socketiohttp']="http://".$_SERVER['SERVER_NAME'].":7321";