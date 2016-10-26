@extends('boardList')

@section('search')
	<p>検索結果</p>
	@if($boards->total() != 0)
		<p>{{ $boards->total() }}件中 {{ $boards->firstItem() }} - {{ $boards->lastItem() }}件表示</p>
	@else
		<p>一致するスレッドは見つかりませんでした。</p>
	@endif
@endsection

@section('links')
	{{ $boards->appends(Request::only('target', 'keyword'))->links() }}
@endsection