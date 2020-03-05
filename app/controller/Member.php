<?php
/*
 * @Author: Kingsr
 * @Date: 2020-03-05 19:14:23
 * @LastEditors: Kingsr
 * @LastEditTime: 2020-03-05 23:05:51
 * @Description: file content
 */

declare(strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Members;
use think\exception\ValidateException;

class Member extends BaseController
{
    public function index()
    {
        if (!Members::isLogin()) {
            return json(['code' => 0, 'msg' => '请先登录']);
        }
        $user = Members::with(['rss', 'subscribe'])->find(session('uid'));
        return json(['code' => 1, 'msg' => '成功', 'data' => $user]);
    }

    public function login()
    {
        $email = $this->request->post('email');
        $pwd = $this->request->post('pwd');

        $user = Members::getByEmail($email);
        if (empty($user)) {
            return json(['code' => -1, 'msg' => '用户不存在']);
        }
        if (password_verify($pwd, $user->password)) {
            $user->last_login_ip = $this->request->ip();
            $user->last_login_time = time();
            session('uid', $user->uid);
            return json(['code' => 1, 'msg' => '登录成功']);
        } else {
            return json(['code' => 0, 'msg' => '用户名或密码错误']);
        }
    }

    public function register()
    {
        $data = $this->request->post();
        try {
            $this->validate($data, [
                'username' => 'require',
                'email' => 'require|email',
                'password' => 'require'
            ]);
        } catch (ValidateException $th) {
            return json(['code' => -1, 'msg' => $th->getError()]);
        }
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        Members::create($data);
        return json(['code' => 1, 'msg' => '注册成功']);
    }
}
