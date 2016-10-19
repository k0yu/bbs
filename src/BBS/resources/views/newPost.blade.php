@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New Post</div>

                <div class="panel-body">
					<form class="form-group" role="form" method="POST" action="{{ url('/board') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" class="form-control" id="title" placeholder="Title" name="title">
						</div>
						<div class="form-group">
							<label for="text">Text</label>
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
