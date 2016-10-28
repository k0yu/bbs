@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Update</div>

                <div class="panel-body">
					<form class="form-group" role="form" method="POST" action="{{ url('/comment/'.$comment->id) }}">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="PUT">
						<div class="form-group @if(!empty($errors->first('text'))) has-error @endif">
							<label for="text" class="control-label">Text</label>
							<textarea class="form-control" rows="5" id="text" name="text">@if(null == old('text')){{ $comment->text }}@else{{ old('text') }}@endif</textarea>
							<span class="help-block">{{$errors->first('text')}}</span>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
