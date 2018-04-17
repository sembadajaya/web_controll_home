<form class="form-horizontal" id="form-kategori" action="<?php base_url();?>index.php/device/add">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	<input type="hidden" name="form" value="kategori">
	<div class="form-group">
		<div class="col-xs-10">
			<input class="form-control" type="text" name="nama_kategori" placeholder="add new">
		</div>
		<button class="btn btn-success" onclick="save_kategori()"><span class="glyphicon glyphicon-floppy-disk"></span></button>
	</div>
</form>
<table class="table" id="table-data">
	<thead>
		<th>Category</th>
		<th>Options</th>
	</thead>
	<tbody id="table-body">
	<?php foreach ($kategori as $key) { ?>
		<tr data-id="<?php echo $key['id_kategori']?>">
			<td><?php echo 
				"<span class='span-nama_kategori caption' data-id=".$key['id_kategori'].">".$key['nama_kategori']."</span>
				<input type='text' class='field-nama form-control editor' value='".$key['nama_kategori']."' data-id='".$key['id_kategori']."' form-data='kategori'/>";?>
			</td>
			<td><button class='btn btn-danger hapus-member' data-id='<?php echo $key['id_kategori']?>'><i class='glyphicon glyphicon-remove'></i></button></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<script type="text/javascript">
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

	$("div").on("click", function(){
		$(this).find("span[class~='caption']").fadeIn();
		$(this).find("input[class~='editor']").hide();
	});


	$(document).on("keydown", ".editor", function(e){
		if(e.keyCode == 13){
			var target = $(e.target);
			var value = target.val();
			var id = target.attr("data-id");
			var form = target.attr("form-data");
			var data = {id:id, form:form, value:value};
			if(target.is(".nama")){
				data.nama_kategori = "nama";
			}

			$.ajax({
				type : "POST",
				dataType : "JSON",
				data : data,
				url : "<?php echo base_url('index.php/device/update'); ?>",
				success :function(a){
					target.hide();
					target.siblings("span[class~='caption']").html(value).fadeIn();
				}
			})
		}
	});

	$(document).on("click",".hapus-member",function(){
		var id=$(this).attr("data-id");
		if(confirm ('are you sure ?'))
		{
			$.ajax({
				url:"<?php echo base_url('index.php/device/delete/kategori/'); ?>"+id,
				success: function(){
					$("tr[data-id='"+id+"']").fadeOut("fast",function(){
						$(this).remove();
					});
				}
			});
		}
	});
});
</script>