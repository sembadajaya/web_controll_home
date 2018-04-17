<!-- Modal -->
<div class="modal fade" id="modal_device" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Device form</h4>
      </div>
      <div class="modal-body">
        <form action="<?php base_url()?>index.php/device/" id="form-device" class="form-horizontal">
        	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input type="hidden" name="form" value="device">
			<input type="hidden" name="id_device" value="">
			<div class="form-body">
			  <div class="form-group">
			    <label class="control-label col-xs-3">Nama Device</label>
			    <div class="col-xs-9">
				  <input type="text" class="form-control" name="nama_device">
				</div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-xs-3">Kategori</label>
			    <div class="col-xs-9">
				  <select class="form-control" name="kategori">
				  <?php
				  	foreach ($kategori as $value) {
				  		echo '<option value="'.$value['id_kategori'].'">'.$value['nama_kategori'].'</option>';
				  	}
				  ?>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-xs-3">Type Device</label>
			    <div class="col-xs-9">
				  <select class="form-control" id="choosetype" name="typeDevice">
				  	<option value="gpio"> Gpio </option>
				  	<option value="wifi"> Ip Address </option>
				  	<option value="rf"> Radio Frequency </option>
				  </select>
				</div>
			  </div>
			  <div id="formtype">
			  <!--FORM TYPE-->
			  </div>
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save_device()" class="btn btn-primary">Save</button>
        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	$(function(){

	$.ajaxSetup({
		type:"POST",
		cache: false,
	});

	$("#addDevice").click(function(){

		var value=$("#choosetype").val();
		$.ajax({
			url: "<?php echo base_url('index.php/main/form_type'); ?>",
			data:{value:value},
			success: function(respond){
				$("#formtype").html(respond);
			}
		});
	});

	$("#choosetype").change(function(){

		var value=$(this).val();
		$.ajax({
			url: "<?php echo base_url('index.php/main/form_type'); ?>",
			data:{value:value},
			success: function(respond){
				$("#formtype").html(respond);
			}
		});
	});
	
});
</script>