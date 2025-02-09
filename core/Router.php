<?php

namespace Core;

use App\Exceptions\RouteNotFoundException;

class Router{
    private $routes = [];
    private $middlewares = [];

    public function register($method, $route, $action, $middleware = null){
        $this->routes[$method][$route] = $action;
        if($middleware){
            $this->middlewares[$route] = $middleware;
        }
        return $this;
    }

    public function get($route, $action, $middleware = null){
        return $this->register('get', $route, $action, $middleware);
    }

    public function post($route, $action, $middleware = null){
        return $this->register('post', $route, $action, $middleware);
    }

    public function group($prefix, $callback, $middleware = null) {
        $callback(new class($this, $prefix, $middleware) {
            private Router $router;
            private string $prefix;
            private $middleware;

            public function __construct(Router $router, string $prefix, $middleware) {
                $this->router = $router;
                $this->prefix = rtrim($prefix, '/');
                $this->middleware = $middleware;
            }

            public function get(string $route, $action) {
                return $this->router->get($this->prefix . '/' . ltrim($route, '/'), $action, $this->middleware);
            }

            public function post(string $route, $action) {
                return $this->router->post($this->prefix . '/' . ltrim($route, '/'), $action, $this->middleware);
            }
        });

        return $this;
    }

    public function resolve($requestUri, $method){
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$method][$route] ?? null;
        $middleware = $this->middlewares[$route] ?? null;
        $params = [];
        
        if(!$action){
            foreach($this->routes[$method] as $key => $value){
                if(str_contains($key, '{')){
                    $res = explode('{', $key);
                    if(str_contains($route, $res[0])){
                        $currentRoute = explode($res[0],$route)[1];
                        $savedRoute = explode($res[0],$key)[1];

                        if(count(explode('/',$currentRoute)) == count(explode('/',$savedRoute))){
                            $result = explode('/',$currentRoute);
                            for($i=0; $i<count($result); $i++){
                                $params[] = $result[$i];
                            }
                            $action = $this->routes[$method][$key];
                        }
                    }
                }
            }
            if(count($params) == 0){
                throw new RouteNotFoundException();
            }
        }
        if($middleware){
            $midd = new $middleware[0];
            $param = $middleware[1] ?? null;
            call_user_func_array([new $midd, 'handle'], [$param]);
        }

        if(is_callable($action))
            return call_user_func_array($action, $params);

        if(is_array($action)){
            [$class, $method] = $action;

            if(class_exists($class)){
                $class = new $class();

                if(method_exists($class, $method)){
                    return call_user_func_array([$class, $method], $params);
                }
            }
        }

        throw new RouteNotFoundException();
    }
}