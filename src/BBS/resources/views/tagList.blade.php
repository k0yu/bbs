@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					タグ検索結果
					@if($tags->total() != 0)
						<span>{{ $tags->total() }}件中 {{ $tags->firstItem() }} - {{ $tags->lastItem() }}件表示</span>
					@else
						<p>一致するタグは見つかりませんでした。</p>
					@endif
				</div>
				<div class="panel-body">
					@foreach($tags as $tag)
						<a href="{{ url('/tag/'.$tag->id) }}">
							<button type="submit" class="btn btn-primary btn-xs">{{ $tag->name }}</button>({{ $tag->boards()->count() }})
						</a>
					@endforeach
				</div>
			</div>
        </div>
		<div class="text-center">{{ $tags->appends(Request::only('target', 'keyword'))->render()}}</div>
    </div>
</div>
@endsection
