$(function(){

	$.ajaxSetup({
		type:"POST",
		url: "index.php/main/get_device",
		cache: false,
	});

	$("#kategori").change(function(){

		var value=$(this).val();
		if(value>0){
			$.ajax({
				data:{id_kategori:value},
				success: function(respond){
					$("#device-kategori").html(respond);
				}
			})
		}

	});
});