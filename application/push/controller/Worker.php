<?php
namespace app\push\controller;
use think\worker\Server;
class Worker extends Server{
    
    protected $socket = 'websocket://127.0.0.1:2346'; 
    protected $uidConnections=[];
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {   
        //$connection->send($connection->id,$data);
        $data=json_decode($data);
        if(!isset($connection->uid))
        {
            // 没验证的话把第一个包当做uid（这里为了方便演示，没做真正的验证）
            $connection->uid = $data->uid;
            /* 保存uid到connection的映射，这样可以方便的通过uid查找connection，
             * 实现针对特定uid推送数据
             */
            $this->worker->uidConnections[$connection->uid] = $connection;
            return $connection->send('login success, your uid is ' . $connection->uid);
        }
        //list($recv_uid, $message) = explode(':', $data);
        $recv_uid=$data->uid;
        $message=$data->type;
        // 全局广播
        if($recv_uid == 'all')
        {
            $this->broadcast($message);
        }
        // 给特定uid发送
        else
        {
            $this->sendMessageByUid($recv_uid, $message);
        }
    }
    
    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {
        echo "new connection from ip " . $connection->getRemoteIp() . "\n";
        //print_r($connection);
    }
    
    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        if(isset($connection->uid))
        {
            // 连接断开时删除映射
            unset($this->worker->uidConnections[$connection->uid]);
        }
    }
    
    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }
    
    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {
    
    }
    
   public function broadcast($message)
    {
        foreach($this->worker->uidConnections as $connection)
        {
            $connection->send($message);
        }
    }
    
    // 针对uid推送数据
   public function sendMessageByUid($uid, $message)
    {   
        if(isset($this->worker->uidConnections[$uid]))
        {
            $connection = $this->worker->uidConnections[$uid];
            $connection->send($message);
        }
    }
}