<?php


namespace app\admin\controller;


class Article extends  Base
{
    //文章列表
    public function list()
    {
        $articles=model('Article')->with('cate')->order(['is_top' => 'asc', 'create_time' => 'desc'])->paginate(10);
        $this->assign('articles',$articles);
        return view();
    }
    //文章添加
    public function add()
    {
        if (request()->isAjax()){
            $data=[
                'title'=>input('post.title'),
                'desc'=>input('post.desc'),
                'tags'=>input('post.tags'),
                'content'=>input('post.content'),
                'is_top'=>input('post.is_top')??0,
                'cate_id'=>input('post.cate_id'),
                'member_id'=>1
            ];
            $result=model('Article')->add($data);
            if ($result['r']==1){
                $this->success('文章添加成功','admin/article/list');
            }else{
                $this->error($result);
            }

        }
        $cates=model('Cate')->select();
//            $viewData=[
//                'cates'=>$cates
//            ];
        $this->assign('cates',$cates);
        return view();
    }
    //文章推荐
    public function top()
    {
        $data=[
            'id'=>input('post.id'),
            'is_top'=>input('post.is_top')?0:1
        ];
        $result=model('Article')->top($data);
        if ($result==1){
            $this->success('操作成功！','admin/article/list');
        }else{
            $this->error('操作失败！');
        }
    }
    //文章编辑
    public function edit()
    {
        if (request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'title'=>input('post.title'),
                'desc'=>input('post.desc'),
                'tags'=>input('post.tags'),
                'content'=>input('post.content'),
                'is_top'=>input('post.is_top'),
                'cate_id'=>input('post.cate_id'),
            ];
            $result=model('Article')->edit($data);
            if ($result==1){
                $this->success('更新成功！','admin/article/list');
            }else{
                $this->error($result);
            }
        }
        $cates = model('Cate')->select();
        $articleInfo = model('Article')->with('cate')->find(input('id'));
        $viewData = [
            'articleInfo' => $articleInfo,
            'cates' => $cates
        ];
        $this->assign($viewData);
        return view();
    }
    //文章删除
    public function del()
    {
        $articleInfo = model('Article')->with('comments')->find(input('post.id'));
        $result = $articleInfo->together('comments')->delete();
        if ($result) {
            $this->success('文章删除成功！', 'admin/article/list');
        }else {
            $this->error('文章删除失败！');
        }
    }
}