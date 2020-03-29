<?php


namespace app\common\model;


use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    use SoftDelete;
    //关联栏目表
    public function cate()
    {
        return $this->belongsTo('cate','cate_id');
    }
    //关联评论
    public function comments()
    {
        return $this->hasMany('Comment','article_id','id');
    }
    //关联会员
    public function member()
    {
        return $this->belongsTo('member','member_id','id');
    }
    //文章添加
    public function add($data)
    {
        $validate=new \app\common\validate\Article();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result=$this->save($data);
        $ids=$this->id;
        if ($result){
            return [
                'r'=>1,
                'id'=>$ids
            ];
        }else{
            return '文章添加失败';
        }
    }
    //文章推荐
    public function top($data)
    {
        $validate=new \app\common\validate\Article();
        if (!$validate->scene('top')->check($data)){
            return $validate->getError();
        }
        $articleInfo=$this->find($data['id']);
        $articleInfo->is_top=$data['is_top'];
        $result=$articleInfo->save();
        if ($result){
            return 1;
        }else{
            return '推荐失败！';
        }
    }
    //文章编辑
    public function edit($data)
    {
        $validate=new \app\common\validate\Article();
        if (!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $articleInfo=$this->with('member')->find($data['id']);
        $articleInfo->title = $data['title'];
        $articleInfo->cate_id = $data['cate_id'];
        $articleInfo->tags = $data['tags'];
        $articleInfo->desc = $data['desc'];
        $articleInfo->content = $data['content'];
        $result = $articleInfo->save();
        if ($result) {
            return 1;
        }else {
            return '文章编辑失败！';
        }
    }

}