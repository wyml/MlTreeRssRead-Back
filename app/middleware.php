<?php
/*
 * @Author: Kingsr
 * @Date: 2020-03-05 00:31:27
 * @LastEditors: Kingsr
 * @LastEditTime: 2020-03-05 01:07:09
 * @Description: file content
 */
// 全局中间件定义文件
return [
    // 全局请求缓存
    // \think\middleware\CheckRequestCache::class,
    // 多语言加载
    // \think\middleware\LoadLangPack::class,
    // Session初始化
    // \think\middleware\SessionInit::class
    app\middleware\Http::class
];
