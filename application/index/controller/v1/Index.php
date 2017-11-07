<?php
namespace app\index\controller\v1;
use think\Controller;
require_once (EXTEND_PATH.'/Gateway.php');
use GatewayClient\Gateway;
class Index extends Controller
{

    public function index($client_id){
        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值
        /* Gateway::$registerAddress = '127.0.0.1:1236';
        // 假设用户已经登录，用户uid和群组id在session中
        $uid      = session('uid');
        $group_id = session('groupid');
        // client_id与uid绑定
        Gateway::bindUid($client_id, $uid);
        // 加入某个群组（可调用多次加入多个群组）
        Gateway::joinGroup($client_id, $group_id); */
        //return config();
        return view();
    }
    
    public function send($uid,$message){
        Gateway::$registerAddress = '127.0.0.1:1236';
        
        // 向任意uid的网站页面发送数据
        Gateway::sendToUid($uid, $message);
        // 向任意群组的网站页面发送数据
        //Gateway::sendToGroup($group, $message);
    }
}
