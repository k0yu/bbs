
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-2">
			<div class="panel panel-success">
				<div class="panel-heading">{{ $user->name }}</div>
					<ul class="list-group">
						<a href="{{ url('/home/'.$user->id) }}" class="list-group-item ">掲示板一覧</a>
						<a href="{{ url('/home/comment/'.$user->id) }}" class="list-group-item">コメント一覧</a>
					</ul>
			</div>
		</div>
        <div class="col-md-10">
            <div class="panel panel-primary ">
                <div class="panel-heading">コメント一覧
				@if($comments->total() != 0)
					({{ $comments->total() }}件中 {{ $comments->firstItem() }} - {{ $comments->lastItem() }}件表示)</div>
				
					<ul class="list-group">
						@foreach($comments as $comment)
						<li class="list-group-item">
							<a href="{{ url('/board/'.$comment->board_id) }}"><p>{{ App\Board::find($comment->board_id)->title }}</p></a>
							<p>{{ $comment->text }}</p>
						</li>
						@endforeach
					</ul>
				@else
					</div>
					<div class="panel-body">
						<p>コメントはありません</p>
					</div>
				@endif
					

            </div>
			@if($comments->total() != 0)
				<div class="text-center">{{ $comments->links() }}</div>
			@endif
        </div>
    </div>
</div>
@endsection

