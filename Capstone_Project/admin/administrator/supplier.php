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
		<div style = "display:none;" id = "add_itr" class = "panel panel-success">	
			<div class = "panel-heading">
				<label>ADD SUPPLIER INFORMATION</label>
				<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
			</div>
			<div class = "panel-body">
				<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
				<div class="row inputRow">
                <div class="col-4">
                    <input type="text" class="form-control"  placeholder="supplier_name" name="supplier_name" value="<?php if (isset($_GET['Supplier']) && $_GET['Supplier']=='UPDATE'){ echo $supplier_name;} ?>">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control"  placeholder="contact_person" name="contact_person" value="<?php if (isset($_GET['Supplier']) && $_GET['Supplier']=='UPDATE'){ echo $contact_person;} ?>">
                </div>
                <div class="col-4">
                    <input type="number" class="form-control"  placeholder="number" name="number" value="<?php if (isset($_GET['Supplier']) && $_GET['Supplier']=='UPDATE'){ echo $number;} ?>">
                </div>
                <div class="col-4">
                    <input type="number" class="form-control"  placeholder="telephone" name="telephone" value="<?php if (isset($_GET['Supplier']) && $_GET['Supplier']=='UPDATE'){ echo $telephone;} ?>">
                </div>
                <div class="col-4">
                    <input type="email" class="form-control"  placeholder="email" name="email" value="<?php if (isset($_GET['Supplier']) && $_GET['Supplier']=='UPDATE'){ echo $email;} ?>">
                </div>
                
            </div>
					<br />
					<div class = "form-inline">
						<button class = "btn btn-primary" name = "addSupplierBtn"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
				</form>
			</div>	
		</div>	
		<?php require 'php.php'
		?>
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>SUPPLIER LIST</Label>
			</div>
			<div class = "panel-body">
				<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD SUPPLIER</button>
				<br />
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>supplier_id</th>
							<th>supplier_name</th>
							<th>contact_person</th>
							<th>number</th>
							<th>telephone</th>
							<th>email</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
						$query = $conn->query("SELECT * FROM `supplier` ORDER BY `supplier_id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						$id = $fetch['supplier_id'];
						//$q = $conn->query("SELECT COUNT(*) as total FROM `complaints` where `supplier_id` = '$id' && `status` = 'Pending'") or die(mysqli_error());
						//$f = $q->fetch_array();
					?>
						<tr>
							<td><?php echo $fetch['supplier_id']?></td>
							<td><?php echo $fetch['supplier_name']?></td>
							<td><?php echo $fetch['contact_person']?></td>				
							<td><?php echo $fetch['number']?></td>				
							<td><?php echo $fetch['telephone']?></td>
							<td><?php echo $fetch['email']?></td>
							<td><center>
							<button class="btn btn-sm btn-info" onclick="removeSupplier(<?php echo $fetch['supplier_id']; ?>)">Remove <span class="badge"></span></button>
							<a href="edit_supplier.php?id=<?php echo $fetch['supplier_id']; ?>" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-pencil"></span> Update</a>
							</center></td>
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









<script type="text/javascript">
    function removeSupplier(supplierId) {
        if (confirm("Are you sure you want to remove this supplier?")) {
            $.ajax({
                url: "php.php",
                type: "POST",
                data: { supplier_id: supplierId },
                success: function(response) {
                    if (response === "success") {
                        // Reload the page to see updated data
                        location.reload();
                    } else {
                        alert("An error occurred while deleting the supplier.");
                    }
                },
                error: function() {
                    alert("An error occurred while processing your request.");
                }
            });
        }
    }
</script>
</body>
</html>