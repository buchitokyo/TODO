<?php
Route::group(['middleware' => 'auth'], function() {

  Route::get('/', 'HomeController@index')->name('home');
  Route::get('/user', 'UserController@index')->name('users.index');
  // ルート定義にnameメソッドをチェーンすることで、そのルートに名前がつけられる
  Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

  // folder追加
  Route::get('/folders/create','FolderController@showCreateForm')->name('folders.create');
  Route::post('/folders/create','FolderController@create');
  Route::delete('/folders/{folder}', 'FolderController@destroy')->name('folders.delete');

    Route::group(['middleware' => 'can:view,folder'], function() {
      // task追加
      Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
      Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

      //Task編集
      Route::get('/folders/{folder}/tasks/{task}/edit','TaskController@showEditForm')->name('tasks.edit');
      Route::post('/folders/{folder}/tasks/{task}/edit','TaskController@edit');

      //Task削除
      Route::delete('/folders/{folder}/tasks/{task}', 'TaskController@destroy')->name('tasks.delete');

      Route::get('/folders/{folder}/tasks/{task}', 'TaskController@list')->name('tasks.list');
    });
});

Auth::routes();
?>
