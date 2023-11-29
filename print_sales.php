<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM sales_list where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k => $val){
		$$k = $val;
	}
	$inv = $conn->query("SELECT * FROM inventory where type=2 and form_id=".$_GET['id']);
	if($customer_id > 0){
		$cname = $conn->query("SELECT * FROM customer_list where id = $customer_id ");
		$cname = $cname->num_rows > 0 ? $cname->fetch_array()['name']: "Guest";
	}else{
		$cname = "Guest";
	}
	
}
$product = $conn->query("SELECT * FROM product_list  order by name asc");
	while($row=$product->fetch_assoc()):
		$prod[$row['id']] = $row;
	endwhile;
$cat = $conn->query("SELECT * FROM unit_list order by name asc");
	while($row=$cat->fetch_assoc()):
		$unit_arr[$row['id']] = $row['name'];
	endwhile;

?>
<div class="container-fluid" id="print-sales">
	<style>
		.supplier-info{
			text-align: center;
			line-height: 20px;
		}
		.card{
			max-width: auto;
			margin: 0 auto;
			border: 1px solid black; 
			padding: 15px;
		}
		h5{
			text-align: center;
		}
		.top{
			display: flex;
			justify-content: space-between;
		}
		table{
			border-collapse: collapse;
		}
		.wborder{
			border:1px solid;
		}
		.wborder_new{
			border:1px;
			max-height: 30px;
		}
		.bbottom{
			border-bottom: 1px solid black
		}
		td p , th p{
			margin: unset;
		}
			.text-center{
				text-align: center;
			}
			.text-right{
				text-align: right;
				padding-right: 5px;
			}
			.text-left{
				text-align: left;
				padding-left: 5px;
			}
			.text-right-new{
				text-align: right;
				padding-right: 10px;
			}
			.text-left-new{
				text-align: left;
				padding-left: 10px;
			}
			.clear{
				padding: 10px;
			}
			.end{
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			}
			.amount{
			display: flex;
			}
			.sign{
			margin-top: 50px;
			margin-right: 25px;
			}
			#uni_modal .modal-footer{
				display: none;
			}
			.title, .main{
				font-size: 17px;
			}
			.small{
				font-size: 10px;
			}
			.detail{
				font-size: 15px;
			}
	</style>
				<div class="card">
					<div class="small text-center">Tax Invoice</div><br>
						<div class="supplier-info">
									<div class="main"><b>PSG</b></div>
									<div class="sub"><b>Cakes & Bakes</b></div>
									<div>1/57, Avinashi Road,<br>Peelamedu, Coimbatore-641004.</div>
						</div>
						<div class="top">						
								<div width="50%" class="text-left-new">Invoice No: <?php echo $ref_no ?></div>
								<div width="50%" class="text-right-new">Date : <?php echo date("d-m-Y",strtotime($date_created)) ?></div>
						</div>
						<div class="row">
							<div class="text-left-new">Customer : <?php echo ucwords($cname) ?></div>
						</div><br><br>
					<table frame="box" width="100%" style="padding: 0 20px;">
						<tr>
							<th width="5%" class="wborder">S.No</th>
							<th width="20%" class="wborder">Product</th>
							<th width="14%" class="wborder">HSN Code</th>
							<th width="13%" class="wborder">Price</th>
							<th width="5%" class="wborder">Qty</th>
							<th width="8%" class="wborder">Per</th>
							<th width="15%" class="wborder">Amount</th>
							<th width="5%" class="wborder">GST</th>
							<th width="15%" class="wborder">Total</th>
						</tr>
						<?php 
						$s_no = 0;
						while($row = $inv->fetch_assoc()): 
							$s_no = $s_no + 1;
							foreach(json_decode($row['other_details']) as $k=>$v){
								$row[$k] = $v;
							}
						?>
						<tr>
							<td class="wborder text-center">
								<?php echo $s_no ?>
							</td>
							<td class="wborder text-left">
								<p class="pname"><b><?php echo $prod[$row['product_id']]['name'] ?></b></p>
							</td>
							<td class="wborder text-left">
								<p class="pdesc"><small><i><b><?php echo $prod[$row['product_id']]['hsn_code'] ?></b></i></small></p>
							</td>
							<td class="wborder text-right"><?php echo '₹ '.number_format($row['price'],2) ?></td>
							<td class="wborder text-center">
								<?php echo $row['qty'] ?>
							</td>
							<td class="wborder text-center"><?php echo $unit_arr[$prod[$row['product_id']]['unit']] ?></td>
							<td class="wborder text-right"><?php echo '₹ '.number_format($row['price'] * $row['qty'],2) ?></td>
							<td class="wborder text-center">
								<?php echo $prod[$row['product_id']]['gst'] ?>
							</td>
							<td class="wborder text-right"><?php echo '₹ '.number_format($row['price'] * $row['qty'] +($row['price'] * $row['qty'] * $prod[$row['product_id']]['gst']/100),2) ?></td>
						</tr>
						<?php endwhile;?>
						<tr>
							<th class="wborder_new" colspan="9"></th>
						</tr>
						<tr>
							<th class="wborder_new" colspan="9"></th>
						</tr>
						<tr>
							<th class="wborder_new" colspan="9"></th>
						</tr>
						<tr>
							<th class="text-right wborder" colspan="7">Total Amount</th>
							<th class="text-right wborder" colspan="2" ><?php echo '₹ '.number_format($total_amount,2) ?></th>
						</tr>
					</table>
					<div class="amount">
						<p>Total amount (in words) : <b> 
							<?php
								$number = $total_amount;
								$no = floor($number);
								$point = round($number - $no, 2) * 100;
								$hundred = null;
								$digits_1 = strlen($no);
								$i = 0;
								$str = array();
								$words = array('50' => 'Fifty','0' => '', '1' => 'One', '2' => 'Two',
									'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
									'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
									'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
									'13' => 'Thirteen', '14' => 'Fourteen',
									'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
									'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
									'30' => 'Thirty', '40' => 'Forty', 
									'60' => 'Sixty', '70' => 'Seventy',
									'80' => 'Eighty', '90' => 'Ninety');
								$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
								while ($i < $digits_1) {
									$divider = ($i == 2) ? 10 : 100;
									$number = floor($no % $divider);
									$no = floor($no / $divider);
									$i += ($divider == 10) ? 1 : 2;
									if ($number) {
										$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
										$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
										$str [] = ($number < 21) ? $words[$number] .
											" " . $digits[$counter] . $plural . " " . $hundred
											:
											$words[floor($number / 10) * 10]
											. " " . $words[$number % 10] . " "
											. $digits[$counter] . $plural . " " . $hundred;
									} else $str[] = null;
								}
								$str = array_reverse($str);
								$result = implode('', $str);
								if($point)
								{
									$tens = $point - ($point % 10);
									$ones = $point % 10;
									$points = $words[$tens] . " " . $words[$ones];
								}
								else{
									$points = '';
								}
								// $points = ($point) ? $words[$point = $point / 10] . " " . $words[$point = $point % 10] : '';
								if($points == "00" || $points == '')
								{
									echo $result . "Rupees Only";
								}
								else
								{
									echo $result . "Rupees " . $points . " Paise Only";
								}
							?> 
							</b>
						</p>
					</div>
					<div class="end">
						<div class="bank-detail">
							<div class="title">Kindly make your payment to:</div>
							<div class="detail">Bank : <b>gdb bank</b><br>A/C No : <b>193773499134</b><br>
								Branch & IFSC Code : <b>th nagar & gdb1226727</b></div>
						</div>
						<div class="sign">
							<p>Authorised Signatory</p>
						</div>
					</div>
					<div class="text-center">This is a system generated invoice</div>
				</div>
				
</div>
<hr>
<div class="text-right">
	<div class="col-md-12">
		<div class="row">
			<button type="button" class="btn btn-sm btn-primary" id="print"><i class="fa fa-print"></i> Print</button>
        	<button type="button" class="btn btn-sm btn-secondary" id="new_sales"><i class="fa fa-plus"></i> New Sales</button>

		</div>
	</div>
</div>

<script>
	$('#print').click(function(){
		// alert_toast($prod,'success')
		var _html = $('#print-sales').clone();
		var newWindow = window.open("","_blank","menubar=no,scrollbars=yes,resizable=yes,width=700,height=600");
		newWindow.document.write(_html.html())
		newWindow.document.close()
		newWindow.focus()
		newWindow.print()
		setTimeout(function(){;newWindow.close();}, 1500);
	})

	$('#new_sales').click(function(){
		location.href = "index.php?page=pos"
	})

</script>

