$(function()
{
	$.ajaxSetup({
		type : "POST",
		cache : false,
		dataType : "JSON"
	});
	$(this).find("input[class~='editor']").hide();

	$(document).on("click", "td",function(){
		$(this).find("span[class~='caption']").hide();
		$(this).find("input[class~='editor']").fadeIn().focus();
	});

	$(document).on("keydown", ".editor", function(e){
		if(e.keyCode == 13){
			var target = $(e.target);
			var value = target.val();
			var id = target.attr("data-id");
			var form = target.attr("form-data");
			var data = {id:id, form:form, value:value};
			if(target.is(".nama")){
				data.modul = "nama";
			}

			$.ajax({
				data : data,
				url : "index.php/Device/update",
				success :function(a){
					target.hide();
					target.siblings("span[class~='caption']").html(value).fadeIn();
				}
			})
		}
	});
});