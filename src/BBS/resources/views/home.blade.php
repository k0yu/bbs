@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
		<div class="col-md-2">
			<div class="panel panel-success">
				<div class="panel-heading">{{ $user->name }}</div>
					<ul class="list-group">
						@if(Auth::user()->id == $user->id)
							<a href="{{ url('/home/edit') }}" class="list-group-item">ユーザー名変更</a>
						@endif
						<a href="{{ url('/home/'.$user->id) }}" class="list-group-item ">掲示板一覧</a>
						<a href="{{ url('/home/comment/'.$user->id) }}" class="list-group-item">コメント一覧</a>
					</ul>
			</div>
		</div>
        <div class="col-md-10">
			@yield('homeContent')
        </div>
    </div>
</div>

@endsection