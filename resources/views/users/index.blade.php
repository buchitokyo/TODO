@extends('shared/layout')
@section('content')

<div class="col col-md-offset-3 col-md-6">
  <div class="panel panel-default">
    <div class="panel-heading">ユーザー一覧</div>
      <div class="panel-body">
        <div class="text-left">
          <table class="table">
            <thead>
                <tr>
                    <th>ユーザー名</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="">{{ $user->name }}</a></td>
                    </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
