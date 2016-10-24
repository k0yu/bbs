

onload = init;

function init(){

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});
	$('#commentList').ready(commentGet());
	
	//$("commentAjax").onclick = commentGet;
	
}

function commentGet(){
	
	$.ajax({
		type: "GET",
		url: $('link[rel="next"]').attr('href'),//"http://localhost/comment/{{ $board->id }}",
		dataType:"json",
		success: function (json) {
			$('#commentList').append(json.view);
			/*for (var i = 0; i < json.data.length; i++){
				$('#commentList').append(
					'<li class="list-group-item"><p>' +
					json.data[i].user_id +
					'</p><p>' +
					'' +
					json.data[i].text +
					'</p></li>'
				
				);
			};*/
			if(json.next_page_url != null){
				$('link[rel="next"]').attr('href', json.next_page_url);
				if(!$('#commentAjax').size()){
					$('#commentList').after(
						'<button class="btn btn-secondary" type="button" id="commentAjax">コメント取得</button>'
					);
					$('#commentAjax').on('click', commentGet);
				}
			}else{
				$('#commentAjax').remove();
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
	 
			// 通信エラー時のダイアログ表示
			console.log(jqXHR + '-' + textStatus + '-' + errorThrown);
		}
	});
}
