<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
?>
<html lang = "eng">
	<head>
		<title>LAFUENTE MEDICAL CLINIC Patient Record Management Information System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "../images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
	</head>
<body>
	<div class = "navbar navbar-default navbar-fixed-top">
		<img src = "../images/logo.png" style = "float:left;" height = "55px" /><label class = "navbar-brand">LAFUENTE MEDICAL CLINIC Patient Record Management Information System - Padre Burgos</label>
			<?php
				$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
				$q = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$_SESSION[admin_id]'") or die(mysqli_error());
				$f = $q->fetch_array();
			?>
			<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php
							echo $f['firstname']." ".$f['lastname'];
							$conn->close();
						?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a class = "me" href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
	</div>
	<div id = "sidebar">
			<?php
			include "sidemenu.php";
			?>
	</div>

    <div id = "content">
		<br />
		<br />
		<br />
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>STOCK LIST</Label>
			</div>
			<div class = "panel-body">
				<br />

				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>product_id</th>
							<th>product_name</th>
							<th>supplier_name</th>
							<th>product_desc</th>
							<th>stock</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
						//$query = $conn->query("SELECT * FROM `supplier` ORDER BY `supplier_id` DESC") or die(mysqli_error());
						$query = $conn->query("SELECT * FROM product INNER JOIN supplier ON product.supplier_id = supplier.supplier_id WHERE product.product_id = product_id ORDER BY `product_id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						$id = $fetch['supplier_id'];
						//$q = $conn->query("SELECT COUNT(*) as total FROM `complaints` where `supplier_id` = '$id' && `status` = 'Pending'") or die(mysqli_error());
						//$f = $q->fetch_array();
					?>
						<tr>
							<td><?php echo $fetch['product_id']?></td>
							<td><?php echo $fetch['product_name']?></td>
							<td><?php echo $fetch['supplier_name']?></td>				
							<td><?php echo $fetch['product_desc']?></td>				
							<td><?php echo $fetch['stock']?></td>
						</tr>
					<?php
						}
						$conn->close();
					?>
					</tbody>
					</table>
			</div>
		</div>
	</div>
        








    <div id = "footer">
		<label class = "footer-title"></label>
        </div>
		<?php include("script.php"); ?>
<script type = "text/javascript">
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
</script>	
</body>
</html>