<?php

namespace app\index\controller;
use think\Db;

class Article extends Base
{
    //文章详情页
    public function info()
    {
        $infos=model('Article')->with('comments,comments.member,member')->find(input('id'));
        $infos->setInc('click');
        $sl=model('Comment')->with('articles')->where('article_id',input('id'))->count();
        $viewdata=[
            'infos'=>$infos,
            'sl'=>$sl
        ];
        $this->assign($viewdata);
        return view();
    }
    //文章评论
    public function comm()
    {
        $data = [
            'content' => input('post.content'),
            'article_id' => input('post.article_id'),
            'member_id' => session('index.id')
        ];
        $result = model('Comment')->add($data);
        if ($result == 1) {
            $this->success('评论成功！');
        }else {
            $this->error($result);
        }
    }
    //投稿
    public function add()
    {
        if (request()->isAjax()){
            $data=[
               'title'=>input('post.title'),
                'tags'=>input('post.tags'),
                'is_top'=>input('post.is_top'),
                'cate_id'=>input('post.cate_id'),
                'desc'=>input('post.desc'),
                'content'=>input('post.content'),
                'member_id'=>session('index.id'),
            ];
            $result=model('Article')->add($data);
            if (is_array($result)){
                if ($result['r']==1){
                    $this->success('文章添加成功',url('index/article/info',['id'=>$result['id']]));
                }else{
                    $this->error($result);
                }
            }
        }
        $cates=model('Cate')->select();
        $this->assign('cates',$cates);
        return view();
    }
}
