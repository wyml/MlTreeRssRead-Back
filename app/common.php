<?php
/*
 * @Author: Kingsr
 * @Date: 2020-03-05 00:31:27
 * @LastEditors: Kingsr
 * @LastEditTime: 2020-03-05 00:34:39
 * @Description: file content
 */
// 应用公共文件

/**
 * CURL_GET
 * @param $url
 * @return mixed
 */

function curlGet($url, $ssl = true)
{
    // 1. 初始化
    $ch = curl_init();
    // 2. 设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    if (!$ssl) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    // 3. 执行并获取HTML文档内容
    $output = curl_exec($ch);
    if ($output === false) {
        echo "CURL Error:" . curl_error($ch);
    }
    // 4. 释放curl句柄
    curl_close($ch);
    return $output;
}

/**
 * CURL_POST
 * @param $url
 * @param $postData
 * @return mixed
 */
function curlPost($url, $postData = null, $ssl = true)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    if (!$ssl) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    $ch_arr = array(CURLOPT_TIMEOUT => 3, CURLOPT_RETURNTRANSFER => 1);
    curl_setopt_array($ch, $ch_arr);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
