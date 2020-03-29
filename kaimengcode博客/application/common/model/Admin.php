<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;
    //只读字段
    protected $readonly=['email'];
    //登录校验
    public function login($data)
    {
        $validate=new \app\common\validate\Admin();
        if (!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        $result=$this->where($data)->find();
        if ($result){
            //判断是否能使用
            if ($result['status']!=1){
                return '此账户被禁用';
            }
            //1表示账户密码正确
            $sessionData = [
                'id'=>$result['id'],
                'nickname'=>$result['nickname'],
                'email'   =>$result['email'],
                'is_super'=>$result['is_super'],
            ];
            session('admin',$sessionData);
            return 1;
        }else{
            return '用户名密码错误';
        }
    }

    //注册账户
    public function register($data)
    {
        $validate=new \app\common\validate\Admin();
        if (!$validate->scene('register')->check($data)){
            return $validate->getError();
        }

        //只插入数据库中有的字段
        $result=$this->allowField(true)->save($data);
        if ($result){
            mailto( $data['email'],'注册账户成功！','注册账户成功！');
            return 1;
        }else{
            return '注册失败';
        }
    }

    //重置密码
    public function reset($data)
    {
        $validate=new \app\common\validate\Admin();
        if (!$validate->scene('forget')->check($data))
        {
            return $validate->getError();
        }
        if ($data['code']!=session('code')){
            return '验证码不正确';
        }
        $adminInfo=$this->where('email',$data['email'])->find();
        $password=mt_rand(10000000,99999999);
        $adminInfo->password=$password;
        $result=$adminInfo->save();
        if ($result){
            $content='恭喜您密码重置成功：'.'<br>'.'用户名：'.$adminInfo['username'].'<br>'.'密码：'.$password;
            mailto($data['email'],'重置密码成功',$content);
            return 1;
        }else{
            return '重置密码失败';
        }
    }

    //管理员添加
    public function add($data)
    {
        $validate=new \app\common\validate\Admin();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result=$this->save($data);
        if ($result){
            return 1;
        }else{
            return '管理员添加失败！';
        }
    }

    //管理员编辑
    public function edit($data)
    {
        $validate=new \app\common\validate\Admin();
        if (!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $adminInfo=$this->find($data['id']);
        $adminInfo->username=$data['username'];
        $adminInfo->password=$data['password'];
        $adminInfo->nickname=$data['nickname'];
        $adminInfo->email=$data['email'];
        $adminInfo->status=$data['status'];
        $adminInfo->is_super=$data['is_super'];
        $result=$adminInfo->save();
        if ($result){
            return 1;
        }else{
            return '编辑失败！';
        }
    }
}
