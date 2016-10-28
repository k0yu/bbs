@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">@yield('search', '掲示板一覧 '.$boards->total().'件中'.$boards->firstItem().'-'.$boards->lastItem().'件表示')</div>
				<ul class="list-group">
					@foreach($boards as $board)
						<li  class="list-group-item">
							<a href="{{ url('/board/'.$board->id) }}">
								<p>{{ $board->title }}</p>
							</a>
							<a href="{{ url('/home/'.App\User::find($board->user_id)->id) }}">
								{{ App\User::find($board->user_id)->name }}
							</a>
							<span>updatetime:{{ $board->updated_at }}</span>
						</li>
					@endforeach
				</ul>
				
			</div>
			<div class="text-center">@yield('links', $boards->links())</div>
        </div>
    </div>
</div>
@endsection