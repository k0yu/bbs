@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<p>検索結果</p>
			@if($comments->total() != 0)
				<p>{{ $comments->total() }}件中 {{ $comments->firstItem() }} - {{ $comments->lastItem() }}件表示</p>
			@else
				<p>一致するコメントは見つかりませんでした。</p>
			@endif
			<ul class="list-group">
				@foreach($comments as $comment)
					<a href="{{ url('/board/'.$comment->board_id) }}" class="list-group-item">
						<p>{{ $comment->text }} | {{ App\User::find($comment->user_id)->name }}</p>
					</a>
				@endforeach
			</ul>
			{{ $comments->appends(Request::only('target', 'keyword'))->links() }}
        </div>
    </div>
</div>
@endsection
