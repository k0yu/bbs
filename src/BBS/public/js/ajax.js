

onload = init;

function init(){

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});
	$('#commentList').ready(commentGet());
	$('#tagTgl').on('click', tagDeleteBtn);
	
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
						'<button class="btn btn-secondary  center-block" type="button" id="commentAjax">コメント取得</button>'
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

function tagDeleteBtn(){
	
	if($('.tagDeleteBtn').hasClass("hidden")){
		$('.tagDeleteBtn').removeClass("hidden");
		$('.tag').attr('method', 'POST');
		var csrf = $('meta[name="csrf-token"]').attr('content');
		var board_id = $('input[name="board_id"]').attr('value');
		$('.tag').append('<input name="_method" type="hidden" value="PUT"><input type="hidden" name="_token" value="'+
			csrf+
			'"><input type="hidden" name="board_id" value="'+
			board_id+
			'">');
	}else{
		$('.tagDeleteBtn').addClass("hidden");
		$('.tag').attr('method', 'GET');
		$('.tag input[value="PUT"]').remove();
		$('.tag input[name="_token"]').remove();
		$('.tag input[name="board_id"]').remove();
	}
}
