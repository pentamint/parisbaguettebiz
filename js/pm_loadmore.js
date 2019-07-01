jQuery(function($){
	// we will remove the button and load its new copy with AJAX, that's why $('body').on()
	$('body').on('click', '#pm_loadmore', function(){
		$.ajax({
			url : pm_loadmore_params.ajaxurl,
			data : {
				'action': 'loadmore',
				'query': pm_loadmore_params.posts,
				'page' : pm_loadmore_params.current_page,
				'first_page' : pm_loadmore_params.first_page // here is the new parameter
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				$('#pm_loadmore').text('Loading...'); 
			},
			success : function( data ){
 
				$('#pm_loadmore').remove(); // remove button
				$('#pm_pagination').before(data).remove(); // add new posts and remove pagination links
				pm_loadmore_params.current_page++;
 
 
			}
		});
		return false;
	});
});