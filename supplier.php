<?php include('db_connect.php');?>
<style>
	.card{
		margin-top: 55px;
	}
	
</style>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-supplier">
				<div class="card">
					<div class="card-header">
						    New Seller
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Seller Name</label>
								<input type="text" class="form-control" name="name" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label">Shop Name</label>
								<input type="text" class="form-control" name="shopname" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label">Address 1</label>
								<input type="text" class="form-control" name="address1" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label">Address 2</label>
								<input type="text" class="form-control" name="address2" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label">City</label>
								<input type="text" class="form-control" name="city" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label">State</label>
								<input type="text" class="form-control" name="state" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label">GSTIN/UIN</label>
								<input type="text" class="form-control" name="gstin" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label">Contact No</label>
								<input type="number" class="form-control" name="contactno" autocomplete="off">
							</div>
					</div>
												
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-supplier').get(0).reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Seller Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM supplier_list order by id asc");
								while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Shop Name : <b><?php echo $row['shopname'] ?></b></p>
										<p><small>Address : <b><?php echo $row['address1'].",".$row['address2'] ?></b></small></p>
										<p><small><b><?php echo $row['city'].",".$row['state'] ?></b></small></p>
										<p><small>Contact : <b><?php echo $row['contactno'] ?></b></small></p>
										<p><small>GSTIN : <b><?php echo $row['gstin'] ?></b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_supplier" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-shopname="<?php echo $row['shopname'] ?>"  data-address1="<?php echo $row['address1'] ?>" data-address2="<?php echo $row['address2'] ?>" data-city="<?php echo $row['city'] ?>" data-state="<?php echo $row['state'] ?>"  data-gstin="<?php echo $row['gstin'] ?>"  data-contactno="<?php echo $row['contactno'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_supplier" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin:unset;
	}
</style>
<script>
	
	$('#manage-supplier').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_supplier',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				// alert_toast(resp,'success')
			}
		})
	})
	$('.edit_supplier').click(function(){
		start_load()
		var cat = $('#manage-supplier')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='shopname']").val($(this).attr('data-shopname'))
		cat.find("[name='address1']").val($(this).attr('data-address1'))
		cat.find("[name='address2']").val($(this).attr('data-address2'))
		cat.find("[name='city']").val($(this).attr('data-city'))
		cat.find("[name='state']").val($(this).attr('data-state'))
		cat.find("[name='gstin']").val($(this).attr('data-gstin'))
		cat.find("[name='contactno']").val($(this).attr('data-contactno'))
		end_load()
	})
	$('.delete_supplier').click(function(){
		_conf("Are you sure to delete this supplier?","delete_supplier",[$(this).attr('data-id')])
	})
	function delete_supplier($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_supplier',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>