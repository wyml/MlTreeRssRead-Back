<?php
/*
 * @Author: Kingsr
 * @Date: 2020-03-05 19:14:44
 * @LastEditors: Kingsr
 * @LastEditTime: 2020-03-05 23:05:04
 * @Description: file content
 */

declare(strict_types=1);

namespace app\model;

use think\Model;

/**
 * @mixin think\Model
 */
class Members extends Model
{
    //
    protected $pk = 'uid';

    public function rss()
    {
        return $this->hasMany(UserRss::class, 'uid');
    }

    public function subscribe()
    {
        return $this->hasOne(UserSubscribe::class, 'uid');
    }
}
