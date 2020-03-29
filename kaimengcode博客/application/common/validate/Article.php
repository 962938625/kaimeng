<?php


namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title|文章标题' => 'require|unique:article',
        'cate_id|所属栏目' => 'require',
        'tags|标签' => 'require',
        'desc|文章概要' => 'require',
        'content|文章内容' => 'require',
        'is_top|是否推荐'=>'require'
    ];

    public function sceneAdd()
    {
        return $this->only(['title', 'cate_id', 'tags', 'desc', 'content']);
    }
    public function sceneTop()
    {
        return $this->only(['is_top']);
    }
    public function sceneEdit()
    {
        return $this->only(['title', 'cate_id', 'tags', 'desc', 'content']);
    }
}