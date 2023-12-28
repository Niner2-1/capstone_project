<!DOCTYPE html>
<?php
   include 'php.php';

	require_once 'logincheck.php';
	require_once '../database/connect.php';
   
   
	// Fetch all suppliers from the database
	$sql = "SELECT * FROM supplier";
	$all_suppliers = $conn->query($sql);
	
	// Check if the form is submitted and handle the form data
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Retrieve the form data
		$product_name = $_POST['product_name'];
		$supplier_id = $_POST['supplier_id'];
	
	 
		exit;
	}
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
		<style>

		img #imagePreview {
			max-width: 300px;
			max-height: 300px;
			margin-top: 10px;
		}

		</style>
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
				<label>ADD PRODUCT INFORMATION</label>
				<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
			</div>
			<div class = "panel-body">
				<form id = "form_dental" method = "POST" enctype = "multipart/form-data" id="uploadForm">
					<br />
					<label for="imageUpload">Choose an image:</label>
        <input type="file" name="imageUpload" id="imageUpload" accept=".jpg, .jpeg, .png">
        <br>
        <img id="imagePreview" src="#" alt="Image Preview">
					<br />
					<br />
					<div class="col-4">
                    <input type="text" class="form-control"  placeholder="Brand" name="brand" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $brand;} ?>">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control"  placeholder="Product Name" name="product_name" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $product_name;} ?>">
                </div>
                <div class="col-4">
                    <textarea type="text" class="form-control"  placeholder="Product description" name="product_desc" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $product_desc;} ?>"></textarea>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control"  placeholder="Category" name="category" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $category;} ?>">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control"  placeholder="Price" name="price" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $price;} ?>">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control"  placeholder="Discount" name="discount" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $discount;} ?>">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control"  placeholder="Stock" name="stock" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $stock;} ?>">
                </div>
                <div class="col-4">
                    <input type="date" class="form-control"  placeholder="expiry date" name="expiry_date" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $expiry_date;} ?>">
                </div>
				<br />
				<select class="form-select" aria-label="Default select example" name="supplier_id">
                <?php while ($row = mysqli_fetch_assoc($all_suppliers)) : ?>
                    <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
                <?php endwhile; ?>
            	</select>
					<br />
					<br />
					
					
					
					
					<div class = "form-inline">
						<button class = "btn btn-primary" name = "additemBtn"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
					
				</form>
			</div>	
		</div>	
		<?php // require '../add_patient.php'

  
		
		?>
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>PRODUCT LIST</Label>
			</div>
			<div class = "panel-body">
				<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD PRODUCT</button>
				<br />
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Brand</th>
							<th>product name</th>
							<th>description</th>
							<th>category</th>
							<th>price</th>
							<th>stock</th>
							<th>expiry_date</th>
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
						$query = $conn->query("SELECT * FROM Product join supplier on supplier.supplier_id = product.supplier_id ORDER BY `product_id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						$id = $fetch['supplier_id'];
						//$q = $conn->query("SELECT COUNT(*) as total FROM `complaints` where `itr_no` = '$id' && `status` = 'Pending'") or die(mysqli_error());
						//$f = $q->fetch_array();
					?>
						<tr>
							<td><?php echo $fetch['product_id']?></td>
							<td><?php echo $fetch['brand']?></td>
							<td><?php echo $fetch['product_name']?></td>				
							<td><?php echo $fetch['product_desc']?></td>				
							<td><?php echo $fetch['category']?></td>
							<td><?php echo $fetch['price']?></td>
							<td><?php echo $fetch['stock']?></td>
							<td><?php echo $fetch['expiry_date']?></td>
							<td><?php echo $fetch['supplier_name']?></td>
							<td><?php echo $fetch['contact_person']?></td>
							<td><?php echo $fetch['number']?></td>
							<td><?php echo $fetch['telephone']?></td>
							<td><?php echo $fetch['email']?></td>

							<td><center>
							<button class="btn btn-sm btn-info" onclick="removeItem(<?php echo $fetch['product_id']; ?>)">Remove <span class="badge"></span></button>

							<a href = "#" class = "btn btn-sm btn-warning"><span class = "glyphicon glyphicon-pencil"></span> Update</a></center></td>
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
    function removeItem(product_id) {
        if (confirm("Are you sure you want to remove this product?")) {
            $.ajax({
                url: "php.php",
                type: "POST", // Change "POST1" to "POST"
                data: { product_id: productId },
                success: function(response) {
                    if (response === "success") {
                        // Reload the page to see updated data
                        location.reload();
                    } else {
                        alert("An error occurred while deleting the product.");
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