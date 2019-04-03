@extends('shared/layout')

@section('content')
      <div class="container">
        <div class="row">
          <div class="col col-md-3">
            <nav class="panel panel-default">
              <div class="panel-heading">
                フォルダ
              </div>
              <div class="panel-body">
                <!-- folderを追加する画面へ遷移 -->
                <a href="{{ route('folders.create')}}" class="btn btn-default btn-block glyphicon glyphicon-plus">
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
            <div>
              <form action="{{ route('folders.delete',['id' => $folder -> id]) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-default btn-block glyphicon glyphicon-trash" id="delete">  フォルダ削除</button>
              </form>
            </div>
          </div>

          <div class="column col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading">タスク</div>
                <div class="panel-body">
                  <div class="text-right">
                    <!-- TaskControllerでつけた変数名を参照   難しい $current_folder_idでもいけるみたい -->
                    <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block glyphicon glyphicon-plus">
                    <i class="fa fa-plus"></i>タスクを追加する
                  </a>
                  </div>
                </div>
              <table class="table">
                　このページのタスク{{ count($tasks) }}/{{ count($tasks->where('status',3 )) }}件　完了
                <thead>
                <tr>
                  <th class="column col-md-3">タイトル</th>
                  <th class="column col-md-3" height="47">内容</th>
                  <th class="column col-md-1">進捗</th>
                  <th class="column col-md-1">期限</th>
                  <th class="column col-md-1">担当者</th>
                  <th class="column col-md-1" height="47"></th>
                  <th class="column col-md-1" height="47"></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($tasks as $task)
                  <tr>
                    <td><a href="{{ route('tasks.list', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">{{ $task->title }}</a></td>
                    <td>{{ mb_substr($task->content,0,15)."..." }}</td>
                    <!-- status_labelはアクセサメゾットをTask modelで定義 -->
                    <td><span class="label {{ $task -> status_class }}">{{ $task->status_label }}</span></td>
                    <td>{{ $task -> formatted_due_date }}</td>
                    <td>{{ $task -> staff_name }}</td>
                    <td class="edit"><a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}"
                      class="btn btn-success btn-sm glyphicon glyphicon-pencil">編集</td>
                    <td class="delete"><form action="{{ route('tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-sm glyphicon glyphicon-trash" id="delete">削除</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div style="text-align: center">
                {!! $tasks->appends(Request::only('keyword'))->onEachSide(5)->links() !!}
              </div>

            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
  @include('shared.alert.scripts')
@endsection
