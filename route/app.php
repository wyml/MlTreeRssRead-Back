<?php
/*
 * @Author: Kingsr
 * @Date: 2020-03-05 00:31:27
 * @LastEditors: Kingsr
 * @LastEditTime: 2020-03-05 23:14:22
 * @Description: file content
 */
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::rule('rssrequire', 'index/RssRequire', 'POST');
Route::rule('rsslist', 'index/RssList');
Route::rule('search', 'index/search', 'POST|GET');
