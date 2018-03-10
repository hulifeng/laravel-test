<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function (){
    return view('welcome');
});
//用户模块
//注册页面
Route::get('/register', '\App\Http\Controllers\UserController@index');
//注册行为
Route::post('/register', '\App\Http\Controllers\UserController@register');
//登录页面
Route::get('/login', '\App\Http\Controllers\LoginController@index');
//登录行为
Route::post('/login', '\App\Http\Controllers\LoginController@login');
//登出行为
Route::get('/logout', '\App\Http\Controllers\LoginController@logout');
//个人设置页面
Route::get('/user/{id}/setting', '\App\Http\Controllers\PersonController@index');
Route::post('/user/{id}/setting', '\App\Http\Controllers\PersonController@settingStore');

//文章列表页
Route::get('posts', '\App\Http\Controllers\PostController@index');
//文章详情页
Route::get('posts/{post}', '\App\Http\Controllers\PostController@show')->where('post', '[0-9]+');
//创建文章
Route::get('posts/create', '\App\Http\Controllers\PostController@create');
//更新文章
Route::post('posts', '\App\Http\Controllers\PostController@store');
//编辑文章
Route::get('posts/{post}/edit', '\App\Http\Controllers\PostController@edit')->where('post','[0-9]+');
Route::put('posts/{post}', '\App\Http\Controllers\PostController@update')->where('post','[0-9]+');
//删除文章
Route::get('posts/{post}/delete', '\App\Http\Controllers\PostController@delete');
//文章评论
Route::post('posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
//赞文章
Route::get('posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
//取消点赞文章
Route::get('posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');
//搜索
Route::post('posts/search','\App\Http\Controllers\PostController@search');
//个人主页
Route::get('user/{user}', '\App\Http\Controllers\UserController@show')->where('user','[0-9]+');
//关注
Route::post('user/{user}/doFan','\App\Http\Controllers\UserController@doFan')->where('user','[0-9]+');
//取消关注
Route::post('user/{user}/doUnFan','\App\Http\Controllers\UserController@doUnFan')->where('user','[0-9]+');