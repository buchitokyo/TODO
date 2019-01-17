@extends('shared/layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダを追加する</div>

          <div class="panel-body">
            <!-- ルール違反の内容は $errors 変数に詰めてテンプレートに渡されます。 -->
            @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors -> all() as $message )
                <li>{{ $message }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form action="{{ route('folders.create') }}" method="POST">
              <!-- CSRF 対策 -->
              @csrf
              <div class="form-group">
                <label for="title">フォルダ名</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="フォルダ名を入力する">
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
      </div>
    </div>
  </div>
@endsection
