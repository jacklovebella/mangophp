<?php
/*
|-------------------------------------------------------------------------------------------
| mangophp 框架的加载驱动 
|-------------------------------------------------------------------------------------------
| Auther：顾杰
*/ 
namespace Mango\Core;
use Illuminate\Database\Capsule\Manager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Noodlehaus\Config;
use Pimple\Container;

/**
 * Class App
 * @package App\Core
 */
class App
{
    use Handle;

    /**
     * @var $container
     */
    protected static $container;

    /**
     * @var $config
     */
    protected static $config;

    /**
     * Init container
     */
    public function initContainer()
    {
        
        $container = new Container();
        // 报错抓取
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();

        //载入我们的config文件
        $config = Config::load(APP_PATH . "config.json");

        //注入到容器，下次可以直接使用
        $container['config'] = $config;

        
        
        //日志服务代码如下，我们使用config作为闭包的参数传进去
        $container['logger'] = function () use ($config) {
            $logger = new Logger($config->get('app_name'));
            $logger->pushHandler(new StreamHandler($config->get('log_file')));
            return $logger;
        };

        //载入 DB
        $capsule = new Manager();
        foreach ($config->get('connections') as $name => $item) {
            $capsule->addConnection([
                'driver'    => $item['driver'],
                'host'      => $item['host'],
                'database'  => $item['name'],
                'username'  => $item['username'],
                'password'  => $item['password'],
                'charset'   => $item['charset'],
                'collation' => $item['collation'],
                'prefix'    => $item['prefix'],
            ], $name);
        }
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        //赋值给静态类属性，方便下次使用
        self::$container = $container;

    }
    /**
     * @return mixed
     */
    public static function getContainer()
    {
        return self::$container;
    }
    /**
     * @return \Monolog\Logger
     */
    public static function Logger()
    {
        return self::$container['logger'];
    }
    /**
     * @return \Noodlehaus\Config
     */
    public static function Config()
    {
        return self::$container['config'];
    }
    /**
     * start app
     */
    public function run()
    {
        $this->initContainer();
        $this->initRoute();
    }
}