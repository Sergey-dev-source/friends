$(function () {
  	$( "#search" ).keyup(function() {
  		let val = $(this).val();
  		let token = $('#tok').val();
  		$.ajax({
  			url: "http://127.0.0.1:8000/search",
  			type: "post",
  			dataType: "json",
  			data: {_token: token,val: val},
  			success: function (data) {
  				let html = '';

	  				$.each(data,function (k,v) {
	  					$.each(v.accounts,function (k1,v1) {
	  						html+= "<a href='/user/"+v.id+"' >"
		  						html+= "<div class='flex'>"
		  							html+= "<div class='search_image'>"
		  								html+= "<img src = '/images/"+v1.avatar+"'>"
		  							html+= "</div>"
		  							html+= "<div class='search_text'>"
		  								html+= "<h2>"+ v.name +"</h2>"
		  							html+= "</div>"
		  						html+= "</div>"
	  						html+= "</a>"
	  					})

	  				})
	  			if (data!='') {
  					$('#ress').css({'padding':'20px'})
	  			}else{
	  				$('#ress').css({'padding':'0px'})
	  			}
  				$('#ress').html(html)
  			}
  		})
	});
})