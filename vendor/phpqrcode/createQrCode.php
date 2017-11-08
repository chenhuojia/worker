<?php
require_once dirname(__FILE__).'/qrlib.php';
$clientId=$_GET['client_id'];
$redis=new Redis();
$redis->connect('127.0.0.1',6379);
$redis->set($clientId,1);
$redis->expire($clientId,10);
$str='https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=STATE#wechat_redirect';
$str=sprintf($str,'wx8ea258c0833e4e0c','https://chenhuojia.xin/index.php','snsapi_base');
echo \QRcode::png($str);
header("Content-Type: image/jpeg");exit;
