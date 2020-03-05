<?php
/*
 * @Author: Kingsr
 * @Date: 2020-03-05 00:31:27
 * @LastEditors: Kingsr
 * @LastEditTime: 2020-03-05 23:32:15
 * @Description: file content
 */

namespace app\controller;

use app\BaseController;
use app\model\SystemRssList;

class Index extends BaseController
{
    public function index()
    {
        return 'welcome to RssReader';
    }

    public function RssRequire()
    {
        $param = $this->request->post('path');
        $rsshub = $this->request->post('rsshub');
        if ($rsshub) {
            $base = env('RSSBASEURL');
            $url = $base . $param;
        } else {
            $url = $param;
        }
        $rss_cache = \cache($param);
        if (empty($rss_cache)) {
            $res = curlGet($url, false);
            \cache($param, $res, 600);
        } else {
            $res = $rss_cache;
        }
        return ($res);
    }

    public function RssList()
    {
        $urls = ['https://rsshub.app/rsshub/routes'];
        $result = [
            'code' => 1,
            'data' => [],
            'time' => time()
        ];
        foreach ($urls as $value) {
            $res = cache($value);
            if (empty($res)) {
                $res = curlGet($value, false);
                cache($value, $res, 3600);
            }
            $xml = simplexml_load_string($res);
            $raw = $xml->channel;
            $title = $raw->title;
            foreach ($raw->item as $item) {
                $_res = [
                    'title' => (string) $item->title,
                    'description' => (string) $item->description,
                    'rule' => (string) $item->guid,
                    'link' => (string) $item->link,
                    'form' => (string) $title,
                    'form_link' => $value
                ];
                $result['data'][] = $_res;
            }
        }
        $systemRss = new SystemRssList;
        $systemRss->saveAll($result['data']);

        return json($result);
    }

    public function search()
    {
        $param = $this->request->param('key');
        if (empty($param)) {
            return json(SystemRssList::select());
        }
        $list = SystemRssList::where('title', 'like', '%' . $param . '%')->select();
        return json($list);
    }
}
