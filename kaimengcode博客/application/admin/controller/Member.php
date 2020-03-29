<?php

namespace app\admin\controller;

class Member extends Base
{
    //会员列表
    public function list()
    {
        $members=model('Member')->order(['id'=>'desc'])->paginate(10);
        $this->assign('members',$members);
        return view();
    }
    //会员添加
    public function add()
    {
        if (request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email')
            ];
            $result=model('Member')->add($data);
            if ($result==1){
                $this->success('会员添加成功！','admin/member/list');
            }else{
                $this->error($result);
            }
        }
        return view();
    }
    //会员编辑
    public function edit()
    {
        if (request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'password'=>input('post.password'),
                'nickname'=>input('post.nickname')

            ];
            $result=model('Member')->edit($data);
            if ($result==1){
                $this->success('会员编辑成功！','admin/member/list');
            }else{
                $this->error($result);
            }
        }
        $memberInfo=model('Member')->find(input('id'));
        $this->assign('memberInfo',$memberInfo);
        return view();
    }
    //会员删除
    public function del()
    {
        $data=[
            'id'=>input('id')
        ];
        $members=model('Member')->with('comments')->find($data['id']);
        $result=$members->together('comments')->delete();
        if ($result){
            $this->success('会员删除成功！','admin/member/list');
        }else{
            $this->error($result);
        }
    }
}
