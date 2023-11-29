<?php include 'db_connect.php' ?>
<style>
	.card{
		margin-top: 35px;
	}
	
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row" style="margin-top:40px; margin-left: 5px;">
			<button class="col-md-2 float-right btn btn-primary btn-sm" id="new_receiving"><i class="fa fa-plus"></i> New Purchase</button>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
				<div class="card-header">
						<h4><b>Purchase Details</b></h4>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<th class="text-center">#</th>
								<th class="text-center">Date</th>
								<th class="text-center">Invoice No #</th>
								<th class="text-center">Seller Name</th>
								<th class="text-center">Amount</th>
								<th class="text-center">Action</th>
							</thead>
							<tbody>
							<?php 
								$supplier = $conn->query("SELECT * FROM supplier_list order by name asc");
								while($row=$supplier->fetch_assoc()):
									$sup_arr[$row['id']] = $row['name'];
								endwhile;
								$i = 1;
								$receiving = $conn->query("SELECT * FROM receiving_list order by date(date_created) desc");
								while($row=$receiving->fetch_assoc()):
							?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class=""><?php echo date("M d, Y",strtotime($row['date_created'])) ?></td>
									<td class=""><?php echo $row['ref_no'] ?></td>
									<td class=""><?php echo isset($sup_arr[$row['supplier_id']])? $sup_arr[$row['supplier_id']] :'N/A' ?></td>
									<td class=""><?php echo '₹ '.$row['total_amount'] ?></td>
									<td class="text-center">
										<a class="btn btn-sm btn-primary" href="index.php?page=manage_receiving&id=<?php echo $row['id'] ?>">Edit</a>
										<a class="btn btn-sm btn-danger delete_receiving" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
									</td>
								</tr>
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$('table').dataTable()
	$('#new_receiving').click(function(){
		location.href = "index.php?page=manage_receiving"
	})
	$('.delete_receiving').click(function(){
		_conf("Are you sure to delete this data?","delete_receiving",[$(this).attr('data-id')])
	})
	function delete_receiving($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_receiving',
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