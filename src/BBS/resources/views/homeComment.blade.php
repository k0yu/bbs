@extends('home')

@section('homeContent')
		  
            <div class="panel panel-primary ">
                <div class="panel-heading">コメント一覧
				@if($comments->total() != 0)
					({{ $comments->total() }}件中 {{ $comments->firstItem() }} - {{ $comments->lastItem() }}件表示)</div>
				
					<ul class="list-group">
						@foreach($comments as $comment)
						<li class="list-group-item">
							<p class="pull-right">更新時間:{{ $comment->updated_at }}</p>
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

@endsection

