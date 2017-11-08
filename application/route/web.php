<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::any('index','index/v1.Index/index');
Route::any('clientId/[:client_id]','index/v1.Index/getClientId');
Route::any('createQrcode/[:client_id]','index/v1.Index/createQrcode');

Route::any('send','index/v1.Index/send');