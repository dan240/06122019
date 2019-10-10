$(document).ready(function(){
	$(".btn").on('click',function(){
		alert("Hello");
		$.ajax({
			url:"{{ url('')}}"
		});
	});
})