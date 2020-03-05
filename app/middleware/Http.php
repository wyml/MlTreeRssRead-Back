<?php
/*
 * @Author: Kingsr
 * @Date: 2020-03-05 01:06:43
 * @LastEditors: Kingsr
 * @LastEditTime: 2020-03-05 01:06:56
 * @Description: file content
 */
declare (strict_types = 1);

namespace app\middleware;

class Http
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        //
        $response = $next($request);

        $response->header([
            'Access-Control-Allow-Origin' => \config('mtf.ACAO') ?? '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PATCH, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With',
        ]);

        return $response;
    }
}
