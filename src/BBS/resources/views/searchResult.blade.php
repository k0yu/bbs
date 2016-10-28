@extends('boardList')

@section('search')
	検索結果
	@if($boards->total() != 0)
		<span class="text-right">{{ $boards->total() }}件中 {{ $boards->firstItem() }} - {{ $boards->lastItem() }}件表示</span>
	@else
		<p>一致するスレッドは見つかりませんでした。</p>
	@endif
@endsection

@section('links')
	{{ $boards->appends(Request::only('target', 'keyword'))->render()}}
@endsection