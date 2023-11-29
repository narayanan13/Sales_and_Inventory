<?php include('db_connect.php');
	// $sku = mt_rand(1,99999999);
	// $sku = sprintf("%'.08d\n", $sku);
	// $i = 1;
	// while($i == 1){
	// 	$chk = $conn->query("SELECT * FROM product_list where id ='$sku'")->num_rows;
	// 	if($chk > 0){
	// 		$sku = mt_rand(1,99999999);
	// 		$sku = sprintf("%'.08d\n", $sku);
	// 	}else{
	// 		$i=0;
	// 	}
	// }
?>
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
			<form action="" id="manage-product">
				<div class="card">
					<div class="card-header">
						    New Product
				  	</div>
					
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">Category</label>
								<select name="category_id" id="" class="custom-select browser-default">
								<?php 

								$cat = $conn->query("SELECT * FROM category_list order by name asc");
								while($row=$cat->fetch_assoc()):
									$cat_arr[$row['id']] = $row['name'];
								?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
								</select>
							</div>
						<div class="form-group">
							<label class="control-label">Product Name</label>
							<input type="text" class="form-control" name="name" autocomplete="off" >
						</div>
						<div class="form-group">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">HSN/SAC Code</label>
								<input type="text" class="form-control" name="hsn_code" autocomplete="off">
							</div>
							
					</div>
						<!-- <div class="form-group">
							<label class="control-label">GST ( % )</label>
							<input type="number" step="any" class="form-control text-right" name="gst" >
						</div> -->
						<div class="form-group">
							<label class="control-label">GST ( % )</label>
							<select name="gst" id="" class="custom-select browser-default">
							<option value="5">5 %</option>
							<option value="12">12 %</option>
							<option value="18">18 %</option>
							<option value="28">28 %</option>
							</select>
						</div>
						<div class="form-group">
								<label class="control-label">Unit</label>
								<select name="unit" id="" class="custom-select browser-default">
								<?php 

								$cat = $conn->query("SELECT * FROM unit_list order by name asc");
								while($row=$cat->fetch_assoc()):
									$unit_arr[$row['id']] = $row['name'];
								?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
								</select>
							</div>
						<div class="form-group">
							<label class="control-label">Product Price</label>
							<input type="number" step="any" class="form-control text-right" name="price" >
						</div>		
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-product').get(0).reset()"> Cancel</button>
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
									<th class="text-center">Product Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$prod = $conn->query("SELECT * FROM product_list order by id asc");
								while($row=$prod->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Name : <b><?php echo $row['name'] ?></b></p>
										<p><small>Category : <b><?php echo $cat_arr[$row['category_id']] ?></b></small></p>
										<p><small>HSN code <b><?php echo $row['hsn_code'] ?></b></small></p>
										<p><small>GST : <b><?php echo $row['gst']." %" ?></b></small></p>
										<p><small>Unit : <b><?php echo $unit_arr[$row['unit']] ?></b></small></p>
										<p><small>Price : <b><?php echo number_format($row['price'],2) ?></b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_product" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-hsn="<?php echo $row['hsn_code'] ?>" data-unit="<?php echo $row['unit'] ?>" data-category_id="<?php echo $row['category_id'] ?>" data-gst="<?php echo $row['gst'] ?>" data-price="<?php echo $row['price'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_product" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
	$('table').dataTable()
	$('#manage-product').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_product',
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
			}
		})
	})
	$('.edit_product').click(function(){
		start_load()
		var cat = $('#manage-product')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='hsn_code']").val($(this).attr('data-hsn'))
		cat.find("[name='category_id']").val($(this).attr('data-category_id'))
		cat.find("[name='gst']").val($(this).attr('data-gst'))
		cat.find("[name='unit']").val($(this).attr('data-unit'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		end_load()
	})
	$('.delete_product').click(function(){
		_conf("Are you sure to delete this product?","delete_product",[$(this).attr('data-id')])
	})
	function delete_product($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_product',
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