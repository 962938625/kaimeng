<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    //软删除
    use SoftDelete;
    //关联文章
    public function article()
    {
        return $this->belongsTo('Article','article_id','id');
    }
    public function articles()
    {
        return $this->hasMany('Article','article','id');
    }
    //关联栏目
    public function member()
    {
        return $this->belongsTo('Member','member_id','id');
    }
    //删除评论
    public function del($data)
    {
        $comments=$this->find($data['id']);
        $result=$comments->delete();
        if ($result){
            return 1;
        }else{
            return '删除失败！';
        }
    }
    public function add($data)
    {
        $validate = new \app\common\validate\Comment();
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '评论失败！';
        }
    }
}
