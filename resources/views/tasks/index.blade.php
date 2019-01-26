@extends('shared/layout')

@section('content')
      <div class="container">
        <div class="row">
          <div class="col col-md-4">
            <nav class="panel panel-default">
              <div class="panel-heading">
                フォルダ
              </div>
              <div class="panel-body">
                <!-- folderを追加する画面へ遷移 -->
                <a href="{{ route('folders.create')}}" class="btn btn-default btn-block glyphicon glyphicon-plus">
                  フォルダを追加する
                </a>
                <!-- <a href="#"
                  class="btn btn-success btn-block" style="margin-top:10px;">編集</a> -->
                <!-- <form action="/" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                <button type="button" class="btn btn-secondary" id ="delete" style="margin-top: 10px;">削除</button> -->
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
            <div>
              <form action="{{ route('folders.delete',['id' => $folder -> id]) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-default btn-block glyphicon glyphicon-trash" id="delete">削除</button>
              </form>
            </div>
          </div>

          <div class="column col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading">タスク</div>
                <div class="panel-body">
                  <div class="text-right">
                    <!-- TaskControllerでつけた変数名を参照   難しい $current_folder_idでもいけるみたい -->
                    <a href="{{ route('tasks.create', ['id' => $folder->id ]) }}" class="btn btn-default btn-block glyphicon glyphicon-plus">
                    <i class="fa fa-plus"></i>タスクを追加する
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
                    <td><a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}"
                      class="btn btn-success btn-sm glyphicon glyphicon-pencil">編集</td>
                    <td><form action="{{ route('tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-sm glyphicon glyphicon-trash" id="delete">削除</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
  @include('shared.alert.scripts')
@endsection
