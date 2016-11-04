
							@foreach($json as $comment)
								<li class="list-group-item">
									<a href="{{ url('/home/'.App\User::find($comment->user_id)->id) }}">{{ App\User::find($comment->user_id)->name }}</a>
									<span class="pull-right">投稿時間:{{ $comment->created_at }} 更新時間:{{ $comment->updated_at }}</span>
									<p>{!! str_replace('&lt;br /&gt;', '<br>', e( nl2br($comment->text) ,ENT_QUOTES) ) !!}</p>
									@if(Auth::user()->id == $comment->user_id)
										<div class="text-right">

											<a href="{{ url('/comment/'.$comment->id).'/edit' }}">
												<button  class="btn btn-info">
													<i class="fa fa-btn fa-pencil"></i>
												</button>
											</a>
											<button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete" data-recipient="{{ url('/comment/'.$comment->id) }}">
												<i class="fa fa-btn fa-trash"></i>
											</button>
										</div>
									@endif
								</li>
							@endforeach
							
							
