<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //共享视图
    public function initialize()
    {
        $cates=model('Cate')->order(['sort'=>'asc'])->select();
        $webInfo=model('System')->find();
        $toparticle=model('Article')->where('is_top',1)->limit(10)->select();
        $viewdata=[
            'cates'=>$cates,
            'webInfo'=>$webInfo,
            'toparticle'=>$toparticle
        ];
        $this->view->share($viewdata);
    }
}
