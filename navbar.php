
<style>
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark' style="margin-top:20px" >
		
		<div class="sidebar-list">

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=inventory" class="nav-item nav-inventory"><span class='icon-field'><i class="fa fa-list"></i></span> Inventory</a>
				<a href="index.php?page=sales" class="nav-item nav-sales"><span class='icon-field'><i class="fa fa-coins"></i></span> Sales</a>
				<a href="index.php?page=receiving" class="nav-item nav-receiving nav-manage_receiving"><span class='icon-field'><i class="fa fa-file-alt"></i></span> Purchase</a>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list"></i></span> Category List</a>
				<a href="index.php?page=product" class="nav-item nav-product"><span class='icon-field'><i class="fa fa-boxes"></i></span> Product List</a>
				<a href="index.php?page=supplier" class="nav-item nav-supplier"><span class='icon-field'><i class="fa fa-truck-loading"></i></span> Seller List</a>
				<a href="index.php?page=customer" class="nav-item nav-customer"><span class='icon-field'><i class="fa fa-user-friends"></i></span> Customer List</a>
				<a href="index.php?page=report" class="nav-item nav-report"><span class='icon-field'><i class="fa fa-outdent"></i></span> Report</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
			<?php endif; ?>
			<a href="index.php?page=backup" class="nav-item nav-backup"><span class='icon-field'><i class="fa fa-briefcase"></i></span> Backup</a>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
<?php if($_SESSION['login_type'] != 1): ?>
	<style>
		.nav-item{
			display: none!important;
		}
		.nav-sales ,.nav-home ,.nav-inventory{
			display: block!important;
		}
	</style>
<?php endif ?>