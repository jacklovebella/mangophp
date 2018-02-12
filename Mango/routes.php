<?php
/*
|--------------------------------------------------------------------------
| mangophp Web Routes | Auther：顾杰
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

return [
    [   
    // 后台模块
        ['GET'],
        '/admin/index',
        'Mango\Services\admin\index@index'
    ],
    //前台模块
    [
        ['GET'],
        '/',
        'Mango\Services\home\index@index'
    ],
    [
        ['GET'],
        '/articles',
        'Mango\Services\home\article@articlesList'
    ]
];


?>