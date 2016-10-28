@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="panel panel-success">
				<div class="panel-heading">
					ユーザー検索結果
					@if($users->total() != 0)
						<span>{{ $users->total() }}件中 {{ $users->firstItem() }} - {{ $users->lastItem() }}件表示</span>
					@else
						<p>一致するユーザーは見つかりませんでした。</p>
					@endif
				</div>
				<ul class="list-group">
					@foreach($users as $user)
						<a href="{{ url('/home/'.$user->id) }}" class="list-group-item">
							<p>{{ $user->name }}</p>
						</a>
					@endforeach
				</ul>
			</div>
        </div>
		<div class="text-center">{{ $users->appends(Request::only('target', 'keyword'))->render()}}</div>
    </div>
</div>
@endsection
