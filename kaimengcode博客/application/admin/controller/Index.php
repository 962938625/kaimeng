<?php


namespace app\admin\controller;


use think\Controller;

class Index extends Controller
{
    //初始化重复登录验证
    public function initialize()
    {
        if (session('?admin.id')){
            $this->redirect('amdin/home/index');
        }
    }

    //后台登录
    public function login()
    {
        if (request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password')
            ];
            //内置函数model访问common中的model
            $result=model('Admin')->login($data);
            if ($result == 1){
                $this->success('登录成功！','admin/home/index');
            }else{
                $this->error($result);
            }
        }
        return view('login');
    }

    //后台注册
    public function register()
    {
        if (request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass' =>input('post.conpass'),
                'nickname'=>input('post.nickname'),
                'email'   =>input('post.email')
            ];
            $result=model('Admin')->register($data);
            if ($result==1){
                $this->success('注册成功！','admin/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //忘记密码
    public function forget()
    {
        if (request()->isAjax())
        {
//            $adminInfo=model('Admin')->where('email',input('post.email'))->find();
            $code=mt_rand(1000,9999);
            session('code',$code);
            $result=mailto(input('post.email'),'重置密码','重置密码验证码：'.$code);
            if ($result)
            {
                $this->success('验证码发送成功');
            }else{
                $this->error('验证码发送失败');
            }

        }
        return view();
    }

    //重置密码
    public function reset()
    {
        $data=[
            'code'=>input('post.code'),
            'email'=>input('post.email')
        ];
        $result=model('Admin')->reset($data);
        if ($result==1){
            $this->success('重置密码成功，新密码请到邮箱查看！','admin/index/login');
        }else{
            $this->error($result);
        }
    }
    public function miss()
    {
        return view();
    }
}