<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
//前台路由
Route::rule('cate/:id','index/index/index','get');
Route::rule('/','index/index/index','get|post');
Route::rule('article-<id>','index/article/info','get');
Route::rule('register','index/index/register','get|post');
Route::rule('login','index/index/login','get|post');
Route::rule('logout','index/index/logout','get|post');
Route::rule('search','index/index/search','get');
Route::rule('comment', 'index/article/comm', 'post');
Route::miss('index/index/miss');
Route::rule('articleadd','index/Article/add','get|post');


//后台路由
Route::group('admin',function (){
    Route::rule('/','admin/index/login','get|post');
    Route::rule('register','admin/Index/register','get|post');
    Route::rule('forget','admin/Index/forget','get|post');
    Route::rule('reset','admin/Index/reset','post');
    Route::rule('index','admin/Home/index','get');
    Route::rule('logout','admin/Home/logout','post');
    Route::rule('catelist','admin/cate/list','get');
    Route::rule('cateadd','admin/cate/add','get|post');
    Route::rule('catesort','admin/Cate/sort','post');
    Route::rule('cateedit/[:id]','admin/cate/edit','get|post');
    Route::rule('catedel/[:id]','admin/cate/del','post');
    Route::rule('articlelist','admin/article/list','get');
    Route::rule('articleadd','admin/Article/add','get|post');
    Route::rule('articletop','admin/Article/top','post');
    Route::rule('articleedit/[:id]','admin/Article/edit','get|post');
    Route::rule('articledel/[:id]','admin/Article/del','get|post');
    Route::rule('memberlist','admin/member/list','get');
    Route::rule('memberadd','admin/member/add','get|post');
    Route::rule('memberedit/[:id]','admin/member/edit','get|post');
    Route::rule('memberdel/[:id]','admin/member/del','get|post');
    Route::rule('adminlist','admin/admin/list','get');
    Route::rule('adminadd','admin/admin/add','get|post');
    Route::rule('adminedit','admin/admin/edit','get|post');
    Route::rule('admindel','admin/admin/del','get|post');
    Route::rule('systemset','admin/System/set','get|post');
    Route::rule('commentlist','admin/comment/list','get|post');
    Route::rule('commentdel/[:id]','admin/comment/del','get|post');
    Route::miss('admin/index/miss');
});