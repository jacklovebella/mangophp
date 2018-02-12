<?php
//at Services/articleController.php

namespace Mango\services\home;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Mango\Models\Content;
use Illuminate\Database\Capsule\Manager as DB;

class articleController
{

    private $container;

    /**
     * 通过构造函数传入的服务容器实体
     * 也可以直接通过App::getContainer()获取
     * articleController constructor.
     */
//    public function __construct($container)
//    {
//        $this->container = $container;
//    }

    public function articlesList(Request $request, Response $response, $vars)
    {   
        // var_dump(Content::all());
        $aa= Content::where('id', 26)->first();
        // $aa= Content::find(1);

        // var_dump($aa->id);exit();
        return $aa;
        // DB::beginTransaction();
        // $date = DB::select("SELECT * from sys_mysql_dictionaries where id = 26");
        // // $date = DB::table("sys_mysql_dictionaries")->select(['id'=>26]);
        // var_dump($date);exit;
        // // DB::rollBack();
        
        // //获取一条内容
        // $rel = Content::first();
        // $data = [];
        // //如果存在则格式化数组返回
        // if ($rel) {
        //     $data = $rel->toArray();
        // }
        // DB::commit();
        // var_dump($data['id']);exit;
        require dirname(APP_PATH).'/../views/articles.html';
        // return ['msg' => 'success', 'data' => $data];
    }
    public function ArticleById(Request $request, Response $response, $vars)
    {  
        $aa = Content::where(['id'=>$vars['id']])->first();
        return $aa;
        
        
    }
    
}