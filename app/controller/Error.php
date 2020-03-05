<?php

declare(strict_types=1);

namespace app\controller;

use think\Request;

class Error
{
    public function __call($method, $args)
    {
        return 'error request!';
    }
}
