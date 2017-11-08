<?php
namespace app\index\controller\v1;
use think\Controller;
require_once (EXTEND_PATH.'/Gateway.php');
use GatewayClient\Gateway;
use think\Session;
class Index extends Controller
{

    public function index(){
        /* // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值
        Gateway::$registerAddress = '127.0.0.1:1236';
        // 假设用户已经登录，用户uid和群组id在session中
        $uid      = session('uid');
        $group_id = session('groupid');
        // client_id与uid绑定
        Gateway::bindUid($client_id, $uid);
        // 加入某个群组（可调用多次加入多个群组）
        Gateway::joinGroup($client_id, $group_id); 
        //return config();
        return view(); */
        //session_start();
        return view();
        $sessionId=$_COOKIE['PHPSESSID'];
        Session::set($sessionId,2);
        return $_COOKIE['PHPSESSID'];
    }
    
    public function send($client_id){
        Gateway::$registerAddress = '127.0.0.1:1238';        
        // 向任意uid的网站页面发送数据
        Gateway::sendToClient($client_id,'22');
        // 向任意群组的网站页面发送数据
       //Gateway::sendToGroup($group, $message);
    }
    
    
    public function getClientId($client_id=0){
        
        if (session::get($client_id)){
            return ['state'=>1];
        }
        return ['state'=>0];
    }
    
    public function createQrcode($client_id=0){
        require_once (VENDOR_PATH.'phpqrcode/qrlib.php');
        $str='https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=STATE#wechat_redirect';
        $str=sprintf($str,'wx8ea258c0833e4e0c','https://chenhuojia.xin/send','snsapi_base');
        echo \QRcode::png($str);  
        // 向任意uid的网站页面发送数据
        Session::set($client_id,99);
        header("Content-Type: image/jpeg");exit;            
    }
}
