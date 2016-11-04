@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="panel panel-info">
				<div class="panel-heading">
					コメント検索結果
					@if($comments->total() != 0)
						<span>{{ $comments->total() }}件中 {{ $comments->firstItem() }} - {{ $comments->lastItem() }}件表示</span>
					@else
						<p>一致するコメントは見つかりませんでした。</p>
					@endif
				</div>
				<ul class="list-group">
					@foreach($comments as $comment)
						<li class="list-group-item">
							<p class="pull-right">更新時間:{{ $comment->updated_at }}</p>
							<a href="{{ url('/board/'.$comment->board_id) }}"><p>{{ App\Board::find($comment->board_id)->title }}</p></a>
							<a href="{{ url('/home/'.$comment->user_id) }}"><p>{{ App\User::find($comment->user_id)->name }}</p></a>
							<p>{{ $comment->text }}</p>
						</li>
					@endforeach
				</ul>
			</div>
        </div>
		<div class="text-center">{{ $comments->appends(Request::only('target', 'keyword'))->render()}}</div>
    </div>
</div>
@endsection
