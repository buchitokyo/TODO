
@extends('shared/layout')

@section('styles')
  @include('shared.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクを編集する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}"
                method="POST">
                <!-- idは、タスクのフォルダ、task_idは、taskのid -->

              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title"
                       value="{{ old('title', $task->title) }}" />
              </div>

              <div class="form-group">
                <label for="title">内容</label>
                <textarea rows="10" cols="20" class="form-control" name="content" id="content"
                placeholder="内容を入力して下さい。" value="{{ old('content') }}"></textarea>
              </div>

              <div class="form-group">
                <label for="status">進捗</label>
              <!-- 直前の入力値またはデータベースに登録済みの値を比べて、一致する場合に
                   option タグの中に 'selected' を出力 -->
                <select name="status" id="status" class="form-control">
                  <!-- STATUSのキー値（ 1,2,3 )を出力させている -->
                  @foreach(\App\Task::STATUS as $key => $val)
                    <option value="{{ $key }}"
                        {{ $key == old('status', $task->status) ? 'selected' : '' }}>
                    <!-- STATUS['label']の値が出力 -->
                      {{ $val['label'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="due_date">期限</label>
                <input type="text" class="form-control" name="due_date" id="due_date"
                     value="{{ old('due_date', $task->formatted_due_date) }}" />
              </div>

              <div class="form-group">
                <label for="staff">担当者</label>
                  <select name="staff_id" id="staff" class="form-control">
                    @foreach ($staffs as $key => $value)
                      <option value="{{ $key }}"
                        {{ $key == old('staff_id', $task->staff_id ) ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
                </select>
              </div>

              <div class="text-right" style="padding: 20px;">
                <button type="submit" class="btn btn-primary">送信</button>
                <input value="戻る" onclick="history.back();" type="button" class="btn btn-default">
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  @include('shared.flatpickr.scripts')
@endsection
