<?php

Route::get('/', function () {
    return view('welcome');
});

// ルート定義にnameメソッドをチェーンすることで、そのルートに名前がつけられる
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

// folder追加
Route::get('/folders/create','FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create','FolderController@create');

?>
