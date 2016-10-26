@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
		@yield('search')
			<ul class="list-group">
				@foreach($boards as $board)
					<a href="{{ url('/board/'.$board->id) }}" class="list-group-item">
						<p>{{ $board->title }} | {{ App\User::find($board->user_id)->name }}</p>
					</a>
				@endforeach
			</ul>
			@yield('links', $boards->links())
        </div>
    </div>
</div>
@endsection
