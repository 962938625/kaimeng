<?php

namespace app\admin\controller;
class Admin extends Base
{
    //会员添加
    public function add()
    {
        if (request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
                'status'=>input('post.status'),
                'is_super'=>input('post.is_super'),
            ];
            $result=model('Admin')->add($data);
            if ($result==1){
                $this->success('管理员添加成功！','admin/admin/list');
            }else{
                $this->error($result);
            }
        }
        return view();
    }
    //会员列表
    public function list()
    {
        $admins=model('Admin')->order(['id'=>'desc'])->paginate(10);
        $this->assign('admins',$admins);
        return view();
    }
    //文章编辑
    public function edit()
    {
        if (request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
                'status'=>input('post.status'),
                'is_super'=>input('post.is_super'),
            ];
            $result=model('Admin')->edit($data);
            if ($result==1){
                $this->success('编辑成功！','admin/admin/list');
            }else{
                $this->error($result);
            }
        }
        $adminInfo=model('Admin')->find(input('id'));
        $this->assign('adminInfo',$adminInfo);
        return view();
    }
}
