<?php

namespace app\admin\controller;
class Comment extends Base
{

    //评论列表
    public function list()
    {
        $comments=model('Comment')->with('article', 'member')->order(['create_time' => 'desc'])->paginate(10);
        $this->assign('comments',$comments);
        return view();
    }
    //删除评论
    public function del()
    {
        if (request()->isAjax()){
            $data=[
                'id'=>input('post.id')
            ];
            $result=model('Comment')->del($data);
            if ($result==1){
                $this->success('删除成功！','admin/comment/list');
            }else{
                $this->error($result);
            }
        }
    }
}
