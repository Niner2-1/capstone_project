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
			<?php include "sidemenu.php"; ?>
	</div>
	<div id = "content">
		<br />
		<br />
		<br />
		<div class = "panel panel-success">	
			<div class = "panel-heading">
				<label>PATIENT INFORMATION / EDIT</label>
				<a style = "float:right; margin-top:-4px;" href = "patient.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
			<?php
				$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
				$q = $conn->query("SELECT * FROM `patient_record` WHERE `itr_no` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
				$f = $q->fetch_array();
			?>
				<form method = "POST" enctype = "multipart/form-data">
					<div style = "float:left;" class = "form-inline">
						<label for = "itr_no">ITR No:</label>
						<input class = "form-control" value = "<?php echo $f['itr_no'] ?>" disabled = "disabled" size = "3" type = "number" name = "itr_no">
					</div>
		
					<br />
					<br />
					<br />
					<div class = "form-inline">
						<label for = "firstname">Firstname:</label>
						<input class = "form-control" name = "firstname" value = "<?php echo $f['firstname']?>" type = "text" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Middle Name:</label>
						<input class = "form-control" name = "middlename" value = "<?php echo $f['middlename']?>" type = "text" >
						&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Lastname:</label>
						<input class = "form-control" name = "lastname" value = "<?php echo $f['lastname']?>" type = "text" required = "required">
					</div>
					<br />
					<div class = "form-group">
						<label for = "birthdate" style = "float:left;">Birthdate:</label>
						<br style = "clear:both;" />
						<?php 
						$d = date("d",strtotime($f['birthdate']));
						$m = date("m",strtotime($f['birthdate']));
						$y = date("Y",strtotime($f['birthdate']));
						?>
						<select name = "month" style = "width:15%; float:left;" class = "form-control" required = "required">
							<option value = "">Select a month</option>
							<option value = "01" <?php echo intval($m) == 1 ? "selected" : ""; ?>>January</option>
							<option value = "02" <?php echo intval($m) == 2 ? "selected" : ""; ?>>February</option>
							<option value = "03" <?php echo intval($m) == 3 ? "selected" : ""; ?>>March</option>
							<option value = "04" <?php echo intval($m) == 4 ? "selected" : ""; ?>>April</option>
							<option value = "05" <?php echo intval($m) == 5 ? "selected" : ""; ?>>May</option>
							<option value = "06" <?php echo intval($m) == 6 ? "selected" : ""; ?>>June</option>
							<option value = "07" <?php echo intval($m) == 7 ? "selected" : ""; ?>>July</option>
							<option value = "08" <?php echo intval($m) == 8 ? "selected" : ""; ?>>August</option>
							<option value = "09" <?php echo intval($m) == 9 ? "selected" : ""; ?>>September</option>
							<option value = "10" <?php echo intval($m) == 10 ? "selected" : ""; ?>>October</option>
							<option value = "11" <?php echo intval($m) == 11 ? "selected" : ""; ?>>November</option>
							<option value = "12" <?php echo intval($m) == 12 ? "selected" : ""; ?>>December</option>
						</select>
						<select name = "day" class = "form-control" style = "width:13%; float:left;" required = "required">
							<option value = "">Select a day</option>
							<option value = "01" <?php echo intval($d) == 1 ? "selected" : ""; ?>>01</option>
							<option value = "02" <?php echo intval($d) == 2 ? "selected" : ""; ?>>02</option>
							<option value = "03" <?php echo intval($d) == 3 ? "selected" : ""; ?>>03</option>
							<option value = "04" <?php echo intval($d) == 4 ? "selected" : ""; ?>>04</option>
							<option value = "05" <?php echo intval($d) == 5 ? "selected" : ""; ?>>05</option>
							<option value = "06" <?php echo intval($d) == 6 ? "selected" : ""; ?>>06</option>
							<option value = "07" <?php echo intval($d) == 7 ? "selected" : ""; ?>>07</option>
							<option value = "08" <?php echo intval($d) == 8 ? "selected" : ""; ?>>08</option>
							<option value = "09" <?php echo intval($d) == 9 ? "selected" : ""; ?>>09</option>	
							<?php
								
								$a = 10;
								while($a <= 31){
									echo "<option value = '".$a."' ".(intval($d) == $a ? "selected" : "")." >".$a++."</option>";
								}
							?>
						</select>
						<select name = "year" class = "form-control" style = "width:13%; float:left;" required = "required">
							<option value = "">Select a year</option>
							<?php
								$a = date('Y');
								while(1965 <= $a){
									echo "<option value = '".$a."' ".(intval($y) == $a ? "selected" : "").">".$a--."</option>";
								}
							?>
						</select>
						<br style = "clear:both;"/>
						<br />
						<label for = "phil_health_no">Phil Health no:</label>
						<input name = "phil_health_no" class = "form-control" value = "<?php echo $f['phil_health_no']?>" type = "text">
						<br />
						<div class="col-sm-6">
						<label><h3>Address Selector - Philippines</h3><label>
						</div>
						<hr>
						<div class="col-sm-6 mb-3">
							<label class="form-label">Region *</label>
							<select name="region" class="form-control form-control-md" id="region"></select>
							<input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" value = "<?php echo $f['region']?>" >
						</div>
						<div class="col-sm-6 mb-3">
							<label class="form-label">Province *</label>
							<select name="province" class="form-control form-control-md" id="province"></select>
							<input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" value = "<?php echo $f['province']?>">
						</div>
						<div class="col-sm-6 mb-3">
							<label class="form-label">City / Municipality *</label>
							<select name="city" class="form-control form-control-md" id="city"></select>
							<input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
						</div>
						<div class="col-sm-6 mb-3">
							<label class="form-label">Barangay *</label>
							<select name="barangay" class="form-control form-control-md" id="barangay"></select>
							<input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="street-text" class="form-label">Street (Optional)</label>
							<input type="text" class="form-control form-control-md" name="street_address" id="street_address">
						</div>

						<br />
						<label for = "age">Age:</label>
						<input class = "form-control" style = "width:20%;" value = "<?php echo $f['age']?>" name = "age" type = "number">
						<br />
						<label for = "civil_status">Civil Status:</label>
						<input class = "form-control" style = "width:20%;" value = "<?php echo $f['civil_status']?>" name = "civil_status" type = "text" required = "required">
						<br />
						<label for = "sex">Sex:</label>
						<select style = "width:22%;" class = "form-control"  name = "gender" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Male" <?php echo $f['sex'] == "Male" ? "selected" : ""; ?>>Male</option>
							<option value = "Female" <?php echo $f['sex'] == "Female" ? "selected" : ""; ?>>Female</option>
						</select>
					</div>
					<br />
					
					<br />
					<div class = "form-inline">
						<button class = "btn btn-warning" name = "edit_patient"><span class = "glyphicon glyphicon-pencil"></span> SAVE</button>
					</div>
					<?php //require_once 'edit_query.php'
                    $id = $_GET['id'];
                    $last = $_GET['lastname'];
                    if(ISSET($_POST['edit_patient'])){

                        $firstname = $_POST['firstname'];
                        $middlename = $_POST['middlename'];
                        $lastname = $_POST['lastname'];
                        $birthdate = $_POST['year']."/".$_POST['month']."/".$_POST['day'];
                        $age = $_POST['age'];
                        $phil_health_no = $_POST['phil_health_no'];
                        $region = $_POST['region_text'];
                        $province = $_POST['province_text'];
                        $city = $_POST['city_text'];
                        $barangay = $_POST['barangay_text'];
						
                        $civil_status = $_POST['civil_status'];
                        $gender = $_POST['gender'];
                        
                        $conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
                        $conn->query("UPDATE `patient_record` SET `phil_health_no` = '$phil_health_no', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname', `birthdate` = '$birthdate', `age` = '$age', `region` = '$region', `province` = '$province', `city` = '$city', `barangay` = '$barangay', `civil_status` = '$civil_status', `sex` = '$gender' WHERE `itr_no` = '$id' && `lastname` = '$last'") or die(mysqli_error());
                        echo("<script> location.replace(' patient.php');</script>");
                    }
                    ?>
				</form>
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
<script src="../js/ph-address-selector.js"></script>

</body>
</html>