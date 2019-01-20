<?php

Route::group(['middleware' => 'auth'], function() {
Route::get('/', 'HomeController@index')->name('home');
// ルート定義にnameメソッドをチェーンすることで、そのルートに名前がつけられる
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

// folder追加
Route::get('/folders/create','FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create','FolderController@create');

// task追加
Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('/folders/{id}/tasks/create', 'TaskController@create');

//Task編集
Route::get('/folders/{id}/tasks/{task_id}/edit','TaskController@showEditForm')->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit','TaskController@edit');
});

Auth::routes();
?>
