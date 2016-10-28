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
					<p class="text-right">
						<a href="{{ url('/home/'.App\User::find($board->user_id)->id) }}">{{ App\User::find($board->user_id)->name }}</a>
						<span>createTime{{ $board->created_at }}</span>
					</p>
					<p>{!! str_replace('&lt;br /&gt;', '<br>', e( nl2br($board->text) ,ENT_QUOTES) ) !!}</p>
					
					@if(Auth::user()->id == $board->user_id)
						<div class="text-right">
							<form class="form-group pull-right" role="form" method="POST" action="{{ url('/board/'.$board->id) }}">
								{{ csrf_field() }}
								<input name="_method" type="hidden" value="DELETE">
								<button type="submit" class="btn btn-danger">
									<i class="fa fa-btn fa-trash"></i>Delete
								</button>
							</form>
							<form class="form-group" role="form" method="GET" action="{{ url('/board/'.$board->id).'/edit' }}">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-info">
									<i class="fa fa-btn fa-pencil"></i>Edit
								</button>
							</form>
						</div>
					@endif
                </div>
            </div>
			
			
			<div class="panel panel-default">
                <div class="panel-heading">Comment List</div>
                <div class="panel-body">

					@if($board->comments()->exists())
						<ul class="list-group">
							@foreach($board->comments as $comment)
								<li class="list-group-item">
									<p>{{ App\User::find($comment->user_id)->name }}</p>
									<p>{!! str_replace('&lt;br /&gt;', '<br>', e( nl2br($comment->text) ,ENT_QUOTES) ) !!}</p>
									@if(Auth::user()->id == $comment->user_id)
										<div class="text-right">
											<form class="form-group pull-right" role="form" method="POST" action="{{ url('/comment/'.$comment->id) }}">
												{{ csrf_field() }}
												<input name="_method" type="hidden" value="DELETE">
												<button type="submit" class="btn btn-danger">
													<i class="fa fa-btn fa-trash"></i>
												</button>
											</form>
											<form class="form-group " role="form" method="GET" action="{{ url('/comment/'.$comment->id).'/edit' }}">
												{{ csrf_field() }}
												<button  class="btn btn-info">
													<i class="fa fa-btn fa-pencil"></i>
												</button>
											</form>
										</div>
									@endif
								</li>
							@endforeach
						</ul>
					@endif

					<form class="form-group" role="form" method="POST" action="{{ url('/comment') }}">
						{{ csrf_field() }}
						<input type="hidden" name="board_id" value="{{ $board->id }}">
						<div class="form-group">
							<label for="text">Comment</label>
							<textarea class="form-control" rows="5" id="text" name="text"></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
