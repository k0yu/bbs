@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-2">
			<p>name : {{ $user->name }}</p>
		</div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">掲示板一覧({{ count($boards) }}件)</div>

                <div class="panel-body">				
				@if(count($boards) != 0)
					<ul class="list-group">
						@foreach($boards as $board)
							<a href="{{ url('/board/'.$board->id) }}" class="list-group-item">
								<p>{{ $board->title }}</p>
								<p class="boardText">{{ $board->text }}</p>
							</a>
						@endforeach
					</ul>
				@else
					<p>投稿はありません</p>
				@endif
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
