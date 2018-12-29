<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDo APP</title>

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="/css/styles.css">

  </head>
  <body>
    <header>
      <nav class="my-navbar">
        <a class="my=navbar-brand" href="/">ToDo App</a>
      </nav>
    </header>

    <main>
      <div class="container">
        <div class="row">
          <div class="col col-md-4">
            <nav class="panel panel-default">
              <div class="panel-heading">
                フォルダ
              </div>
              <div class="panel-body">
                <!-- folderを追加する画面へ遷移 -->
                <a href="{{ route('folders.create')}}" class="btn btn-default btn-block">
                  フォルダを追加する
                </a>
              </div>
              <div class="list-group">
                @foreach($folders as $folder)
                  <a href="{{ route('tasks.index',['id' => $folder->id]) }}"
                    class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }} ">
                    {{ $folder-> title }}
                </a>
                @endforeach
              </div>
            </nav>
          </div>


          <div class="column col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading">タスク</div>
                <div class="panel-body">
                  <div class="text-right">
                    <a href="#" class="btn btn-default btn-block">
                    タスクを追加する
                  </a>
                  </div>
                </div>
              <table class="table">
                <thead>
                <tr>
                  <th>タイトル</th>
                  <th>状態</th>
                  <th>期限</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($tasks as $task)
                  <tr>
                    <td>{{ $task->title }}</td>
                    <!-- status_labelはアクセサメゾットをTask modelで定義 -->
                    <td><span class="label {{ $task -> status_class }}">{{ $task->status_label }}</span></td>
                    <td>{{ $task -> formatted_due_date }}</td>
                    <td><a href="#">編集</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>

  </body>
</html>
