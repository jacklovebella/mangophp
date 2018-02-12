<?php
/*
|-------------------------------------------------------------------------------------------
| mangophp 框架的前台控制器
|-------------------------------------------------------------------------------------------
| Auther：顾杰
*/

namespace Mango\services\home;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class indexController
{
    public function index(Request $request, Response $response)
    {
        return ['msg'=>'success'];
    }

}