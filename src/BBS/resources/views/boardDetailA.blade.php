@extends('layouts.app')
@section('next')
<link rel="next" href="{{ url('/comment/'.$board->id) }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
					{{ $board->title }}
				</div>

                <div class="panel-body">
					<div class="text-right">
						<p>createTime:{{ $board->created_at }}  updateTime:{{ $board->updated_at }}</p>
						<a href="{{ url('/home/'.App\User::find($board->user_id)->id) }}">{{ App\User::find($board->user_id)->name }}</a>
						
					</div>
					<p>{!! str_replace('&lt;br /&gt;', '<br>', e( nl2br($board->text) ,ENT_QUOTES) ) !!}</p>
					@if($board->tags()->exists())
						<div class="tagList">
						@foreach($board->tags as $tag)
							<form method="GET" action="{{ url('/tag/'.$tag->id) }}" class="pull-left tag">
								<button type="submit" class="btn btn-primary btn-xs">
								{{ $tag->name}} <span class="glyphicon glyphicon-remove-circle hidden tagDeleteBtn" aria-hidden="true"></span> 
								</button>
							</form>
						@endforeach
						</div>
					@endif
					<div class="text-right"><a data-toggle="collapse" href="#list1" id="tagTgl"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></div>
                </div>
				
				<div id="list1" class="panel-collapse collapse">
				<div class="panel-body">
					<form class="form-group" role="form" method="POST" action="{{ url('/tag') }}">
						{{ csrf_field() }}
						<input type="hidden" name="board_id" value="{{ $board->id }}">
						<div class="form-group @if(!empty($errors->first('tag'))) has-error @endif">
							<input type="text" class="form-control" id="tag" placeholder="Tag" name="tag" value="{{ old('tag') }}">
							<span class="help-block @if(empty($errors->first('tag')))hidden @endif">{{$errors->first('tag')}}</span>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Add</button>
						</div>
					
					</form>
					@if(Auth::user()->id == $board->user_id)
						<div class="text-right">
							<form class="form-group pull-right" role="form" method="POST" action="{{ url('/board/'.$board->id) }}">
								{{ csrf_field() }}
								<input name="_method" type="hidden" value="DELETE">
								<button type="submit" class="btn btn-danger">
									<i class="fa fa-btn fa-trash"></i>Delete
								</button>
							</form>
							
							<a href="{{ url('/board/'.$board->id).'/edit' }}">
								<button type="submit" class="btn btn-info">
									<i class="fa fa-btn fa-pencil"></i>Edit
								</button>
							</a>
						</div>
					@endif
				</div>
				</div>
            </div>
			
			
			<div class="panel panel-info">
                <div class="panel-heading">Comment List</div>


					@if($board->comments()->exists())
						<ul class="list-group" id="commentList">
						</ul>
					@else
						<div class="panel-body">
							コメントはありません
						</div>
					@endif
                <div class="panel-footer">
					<form class="form-group" role="form" method="POST" action="{{ url('/comment') }}">
						{{ csrf_field() }}
						<input type="hidden" name="board_id" value="{{ $board->id }}">
						<div class="form-group @if(!empty($errors->first('text'))) has-error @endif">
							<label for="text" class="control-label">Comment</label>
							<textarea class="form-control" rows="5" id="text" name="text">{{ old('text') }}</textarea>
							<span class="help-block">{{$errors->first('text')}}</span>
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
