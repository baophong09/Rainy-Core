<?php

/**
 * Rainy - A Light-Weight PHP Framework For Beginner
 *
 * @package  RainyFramework
 * @author   Dinh Phong <dinhphong.developer@gmail.com>
 *
 * Route Class
 */

namespace Rainy;

class Route
{
    /**
     * Array all route rewrite
     *
     * @var Array
     */
    protected static $listRoute = [];

    /**
     * Rewrite url
     *
     * @param string $urlRequest
     * @param function || string $callback
     *
     * @return string
     */
    public static function rewrite($urlRequest, $callback)
    {
        $route = array();

        $urlRequest = filter_var(trim($urlRequest, '/'), FILTER_SANITIZE_URL);

        $urlRequest = ($urlRequest) ? $urlRequest : '/';

        $route['regex'] = self::buildUrl($urlRequest);

        if(is_string($callback)) {
            $callback = explode('@',$callback);
            $controller = $callback[0];
            $method = $callback[1];

            $route['controller'] = $callback[0];
            $route['method'] = $callback[1];
        } else {
            $route['callback'] = $callback;
        }

        return self::$listRoute[$urlRequest] = $route;
    }

    /**
     * Show all route for debug
     *
     * @return void
     */
    public static function show()
    {
        echo "<pre>";
        var_dump(self::$listRoute);
        echo "</pre>";
    }

    /**
     * get all route for debug
     *
     * @return array
     */
    public static function getAllRoutes()
    {
        return self::$listRoute;
    }

    /**
     * Build Url regex
     *
     * @param String $urlRequest
     *
     * @return String
     */
    public static function buildUrl($urlRequest)
    {
        if($urlRequest == '/') {
            return '/^$/';
        }

        $urlExplode = explode('/', $urlRequest);
        $regex = '';
        $params = array();

        foreach($urlExplode as $url) {

            if(strpos($url, "{") === 0 && substr($url, -1) == "}") {
                $regex .= "([^\/]*?)\/";
                continue;
            }

            if($url == '/') {
                $regex .= "";
                continue;
            }

            $regex .= $url."\/";
        }

        return '/^' . rtrim($regex, '\/') . '$/';
    }

}