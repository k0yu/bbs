@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">New Post</div>

                <div class="panel-body">

					<form class="form-group" role="form" method="POST" action="{{ url('/board') }}">
						{{ csrf_field() }}
						<div class="form-group　@if(!empty($errors->first('title'))) has-error @endif">
							<label for="title" class="control-label">Title</label>
							<input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">
							<span class="help-block">{{$errors->first('title')}}</span>
						</div>
						<div class="form-group　@if(!empty($errors->first('text'))) has-error @endif">
							<label for="text"  class="control-label">Text</label>
							<textarea class="form-control" rows="5" id="text" placeholder="Text" name="text">{{ old('text') }}</textarea>
							<span class="help-block">{{$errors->first('text')}}</span>
						</div>
						<div id="tagList" class="form-group">
							<label for="text" class="control-label">Tag</label>
							<input type="text" id="tag" class="form-control">
							<span class="help-block"></span>
							<input type="button" id="tagAdd" value="TagAdd" class="btn btn-primary">
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
