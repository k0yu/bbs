@extends('main')

@section('content')
<div class="container rows">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">���O�C��</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="POST" action="">
					<div class="form-group">
						<label for="userName">UserName</label>
						<input type="userName" class="form-control" id="userName">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password">
					</div>
					<button type="submit" class="btn btn-default">���O�C��</button>
				</form>
				<button class="btn btn-warning">�V�K�o�^</button>
			</div>
		</div>
	</div>
</div>
						