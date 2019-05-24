@extends('shared/layout')



@section('styles')
    @include('shared.flatpickr.styles')
@endsection


  @section('content')
    <div class="container">
      <div class="row">

        <div class="col col-md-offset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">
              タスクを追加する
            </div>
            <div class="panel-body">
              @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach
              </div>
              @endif

              <!-- /folders/{id}/tasks/create   -->
              <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">

                @csrf

                <div class="form-group">
                  <label for="title">タイトル</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="タイトルを入力して下さい。" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                  <label for="content">コンテント</label>
                  <textarea rows="10" cols="30" class="form-control" name="content" id="content" placeholder="内容を入力して下さい。" value="{{ old('content') }}"></textarea>
                </div>

                <div class="form-group">
                  <label for="due_date">期限日</label>
                  <input type="text" class="form-control" name="due_date" id="due_date" placeholder="期限を入力して下さい。" value="{{ old('due_date') }}">
                </div>

                <div class="form-group">
                  <label for="staff">担当者を選択してください。</label></label>
                  <select name="staff_id" id = "staff" class="form-control">
                    @foreach ($staffs as $key => $value)
                      <option value="{{ $key }}" @if( old('staff_id') == $key ) selected @endif>{{ $value }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="text-right">
                  <input value="戻る" onclick="history.back();" type="button" class="btn btn-default">
                  <button type="submit" class="btn btn-primary">送信</button>
                </div>

              </form>
            </div>
          </nav>
        </div>

      </div>
    </div>
  </main>
@endsection


@section('scripts')
  @include('shared.flatpickr.scripts')
@endsection
