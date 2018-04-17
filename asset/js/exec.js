var save_method;

function add_device()
{
	save_method = 'add-device';
	$('#form-device')[0].reset();
	$('#modal_device').modal('show');
	$('.modal-title').text('Add Device');
}

function edit_device(id)
{
	type = $("tr[data-id='"+id+"']").attr('data-type');
	save_method = 'update-device';

	$('#form-device')[0].reset();
	$('#modal_device').modal('show');
	$('.modal-title').text('Edit Device');
	$.ajax({
		url: base_url + "index.php/main/form_type",
		type:"POST",
		cache: false,
		data:{value:type},
		success: function(data){
			$("#formtype").html(data);
		}
	});

	$.ajax({
		url : base_url + "index.php/main/edit/device/" + id,
		type : "GET",
		dataType : "JSON",
		success : function (data)
		{
			$("input[name='id_device']").val(data.id_device);
			$("input[name='nama_device']").val(data.nama_device);
			$("select[name='typeDevice']").val(data.type_device);
			$("select[name='kategori']").val(data.id_kategori);
			if (data.type_device == "gpio") {
				$("input[name='gpio']").val(data.gpio);
			}
			else if (data.type_device == "wifi") {
				$("input[name='ip-dev']").val(data.ip_device);
			}
			else if (data.type_device == "rf"){
				$("input[name='oncode']").val(data.onrf_code);
				$("input[name='offcode']").val(data.offrf_code);
				$("input[name='pulse']").val(data.pulserf);
			}
		},
		error : function (jqXHR, textStatus, errorThrown)
		{
			alert('error get data from database');
		}
	});
}

function save_device()
{
	var url;

	if (save_method == 'add-device') {
		url = "add";
	}
	else if (save_method == 'update-device') {
		url = "update";
	}

	//ajax adding data to database
	$.ajax({
		url : base_url + $('#form-device').attr('action') + url,
		type : "POST",
		data : $('#form-device').serialize(),
		dataType : "JSON",
		success : function(data)
		{
			$('#modal_form').modal('hide');
			location.reload();
		},
		error : function (jqXHR, textStatus, errorThrown)
		{
			alert('Error adding data to database');
		}
	});
}

function save_kategori(){
	$.ajax({
		url : base_url + $('#form-kategori').attr('action'),
		type : "POST",
		data :  $('#form-kategori').serialize(),
		dataType : "JSON",
		success : function(data)
		{
			location.reload();
		},
		error : function (jqXHR, textStatus, errorThrown)
		{
			alert('Error adding data to database');
		}
	});
}

function delete_device(id)
{
	if(confirm ('are you sure ?')) {
		$.ajax({
			url : base_url +"index.php/device/delete/device/" + id,
			type : "POST",
			dataType : "JSON",
			success : function(status)
			{
				$("tr[data-id='"+id+"']").fadeOut("fast",function(){
						$(this).remove();
					});
			},
			error : function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding data to database');
			}
		});
	}
}

function relay(id)
{
	$.ajax({
		url: base_url +"index.php/device/onoff",
		type : "POST",
		data: {id:id},
		dataType : "JSON",
		context: this,
		success : function(data)
		{
			$("button[data-id='"+id+"']").toggleClass("btn-success btn-danger");
		},
		error : function (jqXHR, textStatus, errorThrown)
		{
			alert('Error action');
		}
			
	});
}