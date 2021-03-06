<?php

/**
 * App类
 * @author 刘健 <code.liu@qq.com>
 */

namespace sys;

class App
{

    // 运行
    public static function run()
    {
        $pathinfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        $result = Route::match($pathinfo);
        Route::destruct();
        if (!$result) {
            throw new \sys\exception\HttpException(404, 'URL不存在');
        }
        list($location, $mode) = $result;
        return self::runController($location, $mode);
    }

    // 将蛇形命名转换为驼峰命名
    public static function snakeToCamel($name, $ucfirst = false)
    {
        $name = ucwords(str_replace('_', ' ', $name));
        $name = str_replace(' ', '', lcfirst($name));
        return $ucfirst ? ucfirst($name) : $name;
    }

    // 执行控制器
    private static function runController($location, $mode)
    {
        // 实例化控制器
        $namespace = dirname($location);
        $methodName = basename($location);
        try {
            $reflect = new \ReflectionClass($namespace);
        } catch (\ReflectionException $e) {
            throw new \sys\exception\RouteException('控制器未找到', $namespace);
        }
        $controller = $reflect->newInstanceArgs();
        // 判断方法是否存在
        if (method_exists($controller, $methodName) || method_exists($controller, $methodName = self::snakeToCamel($methodName))) {
            // 执行控制器的方法
            return \sys\web\Response::instance()->setBody($controller->$methodName());
        }
        if ($mode == Route::BIND_METHOD) {
            throw new \sys\exception\HttpException(404, 'URL不存在');
        }
        throw new \sys\exception\RouteException('方法未找到', $namespace . '->' . $methodName . '()');
    }

}
