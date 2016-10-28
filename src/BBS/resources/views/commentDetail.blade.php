
							@foreach($json as $comment)
								<li class="list-group-item">
									<a href="{{ url('/home/'.App\User::find($comment->user_id)->id) }}">{{ App\User::find($comment->user_id)->name }}</a>
									<span>createTime:{{ $comment->created_at }}</span>
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
											<a href="{{ url('/comment/'.$comment->id).'/edit' }}">
												<button  class="btn btn-info">
													<i class="fa fa-btn fa-pencil"></i>
												</button>
											</a>
										</div>
									@endif
								</li>
							@endforeach
							
							
