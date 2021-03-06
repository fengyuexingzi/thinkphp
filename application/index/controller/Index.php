<?php

namespace app\index\controller;

use app\common\controller\Base;
use JWT\JWT;
use king\Tools;

class Index extends Base
{
    public function index()
    {
        //a
        /**
         * getcwd()
         *
         */

        /*
         var_dump(getcwd());
        var_dump($_SERVER['PHP_SELF']);
        var_dump($_SERVER['DOCUMENT_ROOT']);
        var_dump(__DIR__);
        var_dump($_SERVER['SCRIPT_NAME']);
        */


        $this->assign('__LIST__', [1, 2, 3]);
        $this->assign('demo_time', $this->request->time());
        $this->assign('demo_name', 'king');
        $this->assign('key', 'demo');
        return $this->fetch();
    }

    public function tree()
    {
        $arr = [];
        $arr1 = [];
        $arr2 = [];
        $arr3 = ['king' => 'best'];
        //$arr = array_merge($arr1, $arr2, $arr3);
        var_dump($arr);
    }

    public function hello()
    {
        var_dump(input());
        if ($this->request->isAjax()) {
            var_dump($this->request);
            echo '<br/>';
        }
        return json_encode($this->request->method());
    }

    public function login()
    {

        if ($this->request->isPost()) {
            $username = 'king';
            $password = '123456';

            $in_username = input('username', '', 'htmlspecialchars');
            $in_password = input('password', '', 'htmlspecialchars');

            if ($username == $in_username && $password == $in_password) {
                $payload = [
                    'exp' => time() + 30,
                    'iat' => time(),
                    'jti' => Tools::aes($username),
                    'ver' => 1
                ];
                $privateKey = openssl_pkey_get_private(file_get_contents('../key/private.key'));
                $token = JWT::encode($payload, $privateKey, 'RS256');
                return $token;
            } else {
                return json_encode([
                    'code' => '50001',
                    'data' => '',
                    'msg' => '用户名或密码错误',
                ]);
            }
        }
    }

    public function info()
    {
        error_reporting(0);
        $token = getallheaders()['Authorization'];
        $privateKey = openssl_pkey_get_private(file_get_contents('../key/private.key'));
        $publicKey = openssl_get_publickey(file_get_contents('../key/public.key'));

            var_dump(JWT::decode($token, $publicKey, ['RS256']));
           /* echo json_encode([
                'code' => '50002',
                'data' => [
                    ['name' => 'a', 'sex' => 'b'],
                    ['name' => 'a', 'sex' => 'b'],
                ],
                'msg' => $exception->getMessage()
            ]);*/

        var_dump(Tools::aes('it8jwp62HHlavuRM2trmIw==', 'decrypt'));
    }

    public function test()
    {
        echo 'test';
        return;
    }
}
