
   <style>
	.card{
		margin-top: 35px;
	}
	
</style>


<div class="containe-fluid">

	<div class="row">
		<div class="col-lg-12">
			
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
				<?php echo "Welcome back ".$_SESSION['login_name']."!"  ?>
									
				</div>
				<hr>
				<div class="detail_card" style="display:flex;">
				<div class="container-fluid">
					<div class="alert alert-info">
						<p><b><large>Total Sales (Today)</large></b></p>
					<hr>
						<p class="text-right"><b><large><?php 
						include 'db_connect.php';
						$sales = $conn->query("SELECT SUM(total_amount) as amount FROM sales_list where date(date_created)= '".date('Y-m-d')."'");
						echo $sales->num_rows > 0 ? '₹ '.number_format($sales->fetch_array()['amount'],2) : "0.00";

						?></large></b></p>
					</div>
				</div>
				<div class="container-fluid">
					<div class="alert alert-success">
						<p><b><large>Total Purchase (Month)</large></b></p>
					<hr>
						<p class="text-right"><b><large><?php 
						include 'db_connect.php';
						$new_date = date('Y-m-d');
						$datee = explode('-', $new_date);
						$sales = $conn->query("SELECT SUM(total_amount) as amount FROM receiving_list where MONTH(date_added)= '$datee[1]'");
						echo $sales->num_rows > 0 ? '₹ '.number_format($sales->fetch_array()['amount'],2) : "0.00";

						?></large></b></p>
					</div>
				</div>
				<div class="container-fluid">
					<div class="alert alert-warning">
						<p><b><large>Total Sellers</large></b></p>
					<hr>
						<p class="text-right"><b><large><?php 
						include 'db_connect.php';
						$sales = $conn->query("SELECT count(id) as ids FROM supplier_list");
						echo $sales->num_rows > 0 ? number_format($sales->fetch_array()['ids']) : "0";

						?></large></b></p>
					</div>
				</div>
</div>
			</div>
			
		</div>
		</div>
	</div>

</div>
<script>
	
</script>