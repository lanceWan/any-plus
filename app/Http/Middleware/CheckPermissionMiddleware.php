<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;

use Closure;
use Route;
class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $hasPermission = $this->checkPermission();
        return $hasPermission ? $next($request) : abort(500, '没有权限访问');
    }

    /**
     * 验证用户权限
     * @author 晚黎
     * @date   2017-12-15
     * @return [type]     [description]
     */
    public function checkPermission()
    {
        $method = $this->getCurrentControllerMethod();
        $actionName = $this->getCurrentControllerName();

        return haspermission(strtolower($actionName.'.'.$method));
    }

    /**
     * 获取当前控制器方法
     * @author 晚黎
     * @date   2017-12-15
     * @return [type]     [description]
     */
    private function getCurrentControllerMethod()  
    {  
        return $this->getCurrentActionAttribute()['method'];
    }

    /**
     * 获取当前控制器名称
     * @author 晚黎
     * @date   2017-12-15
     * @return [type]     [description]
     */
    private function getCurrentControllerName()  
    {  
        return $this->getCurrentActionAttribute()['controller'];
    }  

    /**
     * 获取当前控制器相关属性
     * @author 晚黎
     * @date   2017-12-15
     * @return [type]     [description]
     */
    private function getCurrentActionAttribute()  
    {  
        $action = Route::currentRouteAction();
        list($class, $method) = explode('@', $action);
        return ['controller' => class_basename($class), 'method' => $method];
    } 


}
