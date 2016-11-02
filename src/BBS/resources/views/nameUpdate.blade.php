@extends('home')

@section('homeContent')
		   <div class="panel panel-primary ">
                <div class="panel-heading">ユーザー名変更</div>
				<div class="panel-body">
					<form class="form-group" role="form" method="GET" action="{{ url('/home/update') }}">
						{{ csrf_field() }}
						<div class="form-group @if(!empty($errors->first('name'))) has-error @endif">
							<label for="name" class="control-label">Name</label>
							<input type="text" class="form-control" id="name" placeholder="{{ Auth::user()->name }}" name="name" value="@if(null == old('name')){{ Auth::user()->name }}@else{{ old('name') }}@endif">
							<span class="help-block">{{$errors->first('name')}}</span>
						</div>
						<div class="form-group">
								<button type="submit" class="btn btn-primary">変更</button>
						</div>
					</form>
				</div>
			</div>
@endsection
