<?php
//print_r($devicelist);
//print_r($kategori)
?>
<div class="row">
<div class="container">
	<div class="form-group">
    <select id="kategori" class="form-control">  
    	<!--<option>Pilih Kategori</option>	-->
<?php
foreach ($kategori as $jenis) {
	echo "<option value='".$jenis['id_kategori']."'>".strtoupper($jenis['nama_kategori'])."</option>";
} ?>
    </select>
    </div>
</div>
</div>

<div class="row">
		<div class="container">
			<div class="form-horizontal" id="device-kategori">
				
			</div>
		</div>
</div>

<script type="text/javascript">
	$(function(){

	$.ajaxSetup({
		type:"POST",
		cache: false,
	});

	$(document).ready(function(){

		var value=$("#kategori").val();
			$.ajax({
				url: "<?php echo base_url('index.php/main/get_device'); ?>",
				data:{id_kategori:value},
				success: function(respond){
					$("#device-kategori").html(respond);
				}
			})

	});

	$("#kategori").change(function(){

		var value=$(this).val();
			$.ajax({
				url: "<?php echo base_url('index.php/main/get_device'); ?>",
				data:{id_kategori:value},
				success: function(respond){
					$("#device-kategori").html(respond);
				}
			});

	});
	
});
</script>