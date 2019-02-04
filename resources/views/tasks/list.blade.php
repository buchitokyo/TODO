@extends('shared/layout')

@section('content')
      <div class="container">
        <div class="row">

          <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading">タスクの詳細</div>
              <table class="table">
                    <tr>
                      <th width="30" height="47">タイトル</th><td width="554" height="47">{{ $task->title }}</a></td>
                    </tr>
                    <tr>
                      <th width="30" height="47">内容</th width="554" height="47"><td>{{ $task->content }}</td>
                    </tr>
                    <tr>
                      <th width="30" height="47">状態</th><td width="554" height="47"><span class="label {{ $task -> status_class }}">{{ $task->status_label }}</span></td>
                    </tr>
                    <tr>
                      <th width="30" height="47">期限</th><td width="554" height="47">{{ $task -> formatted_due_date }}</td>
                    </tr>
              </table>
            </div>


            <div class="text-right">
              <input value="戻る" onclick="history.back();" type="button" class="btn btn-default">
              <!-- <button type="submit" name="action" value="back" class="btn btn-default">戻る</button> -->
              <a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" class="btn btn-success">編集</a>
            </div>

          </div>
        </div>
      </div>
@endsection

@section('scripts')
  @include('shared.alert.scripts')
@endsection
