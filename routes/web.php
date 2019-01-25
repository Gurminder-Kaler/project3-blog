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

Route::get('/', function () {
    return view('welcome');
});
Route::get('{provider}/auth', [
    'uses'=>'SocialsController@auth',
    'as'=>'social.auth'
]);
Route::get('{provider}/redirect', [
    'uses'=>'SocialsController@auth_callback',
    'as'=>'social.callback'
]);

Route::get('discussion/{slug}',[
    'uses'=>'DiscussionsController@show',
    'as'=>'discussion'
]);


Auth::routes();

Route::get('/forum', 'ForumsController@index')->name('home');

Route::group(['middleware'=>'auth'],function (){
    Route::resource('channels', 'ChannelsController');
    Route::get('discussions/create',[
        'uses'=>'DiscussionsController@create',
        'as'=>'discussions.create'
    ]);
    Route::post('discussion/store',[
        'uses'=>'DiscussionsController@store',
        'as'=>'discussions.store'
    ]);
    Route::post('/discussion/reply/{id}',[
        'uses'=>'DiscussionsController@reply',
        'as'=>'discussion.reply'
    ]);
    Route::get('/reply/like{id}',[
        'uses'=>'ReplyController@like',
        'as'=>'reply.like'
    ]);
});