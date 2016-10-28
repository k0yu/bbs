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
                <div class="panel-heading">掲示板一覧
				@if($boards->total() != 0)
					({{ $boards->total() }}件中 {{ $boards->firstItem() }} - {{ $boards->lastItem() }}件表示)</div>
				
					<ul class="list-group">
						@foreach($boards as $board)
							<a href="{{ url('/board/'.$board->id) }}" class="list-group-item">
								<p>{{ $board->title }}</p>
								<p class="boardText">{{ $board->text }}</p>
							</a>
						@endforeach
					</ul>
				@else
					</div>
					<div class="panel-body">
						<p>投稿はありません</p>
					</div>
				@endif
					

            </div>
			@if($boards->total() != 0)
				<div class="text-center">{{ $boards->links() }}</div>
			@endif
        </div>
    </div>
</div>
@endsection