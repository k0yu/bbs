@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
					{{ $board->title }}
				</div>

                <div class="panel-body">
					<p class="text-right">{{ $user->name }} | {{ $board->created_at }}</p>
					<p>{{ $board->text }}</p>
					
					@if(Auth::user()->id == $board->user_id)
						<form class="form-group text-right" role="form" method="POST" action="{{ url('/board/'.$board->id) }}">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="DELETE">
							<button type="submit" class="btn btn-danger">
								<i class="fa fa-btn fa-trash"></i>Delete
							</button>
						</form>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
