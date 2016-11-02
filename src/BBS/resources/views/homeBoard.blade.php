          
@extends('home')

@section('homeContent')
		  
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
@endsection