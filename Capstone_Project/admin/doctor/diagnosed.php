<!DOCTYPE html>
<?php
	require_once'logincheck.php';
	$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
	$query = $conn->query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]'") or die(mysqli_error());
	$fetch = $query->fetch_array();
?>
<html lang = "en">
	<head>	
		<title>LAFUENTE MEDICAL CLINIC Patient Record Management Information System</title>
		<meta charset = "UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "../images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
	</head>
	<body>
	<div class = "navbar navbar-default navbar-fixed-top">
		<img src = "images/logo.png" style = "float:left;" height = "55px" /><label class = "navbar-brand">LAFUENTE MEDICAL CLINIC Patient Record Management Information System - Padre Burgos</label>
		<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php echo $fetch['firstname']." ".$fetch['lastname'] ?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a class = "me" href = "logout.php"><span class = "glyphicon glyphicon-log-out"></span> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
	</div>
	<br />
	<br />
	<br />
	<div class = "well">
		<div class = "panel panel-warning">
			<div class = "panel-heading">
				<center><label>Lab Test</label></center>
			</div>
		</div>
		<div class = "panel panel-default">
			<div class = "panel-heading">
				<label>TEST FORM</label>	<a style = "float:right; margin-top:-4px;" href = "checkup_pending.php?itr_no=<?php echo $_GET['itr_no']?>" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<form method = "POST" enctype = "multipart/form-data">
			<?php
				$q = $conn->query("SELECT * FROM `patient_record` JOIN `complaints` ON complaints.itr_no = patient_record.itr_no WHERE patient_record.itr_no = '$_GET[itr_no]'") or die(mysqli_error());
				$q1 = $conn->query("SELECT * FROM `complaints` WHERE `com_id` = '$_GET[comp_id]' && `itr_no` = '$_GET[itr_no]'") or die(mysqli_error());
				
				$f1 = $q1->fetch_array();
				$f = $q->fetch_array();
			?>
			<div class = "panel-body">
				<div class = "alert alert-info">Basic Information</div>
				<div style = "width:30%; float:left;">
						<label style = "font-size:18px;">Name</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['firstname']." ".substr($f['middlename'], 0,1)." ".$f['lastname']?></label>
					</div>
					<div style = "width:10%; float:left;">
						<label style = "font-size:18px;">Age</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['age']?></label>
					</div>
					<div style = "width:10%; float:left;">
						<label style = "font-size:18px;">Sex</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['sex']?></label>
					</div>
					<div style = "width:40%; float:left;">
						<label style = "font-size:18px;">Address</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['region']." ".$f['province']." ".$f['city']." ".$f['barangay']?></label>				
					</div>
					<br /><br /><br />
					<hr style = "border:1px dotted #d3d3d3;"/>
					<div class = "form-group" style = "width:15%; float:left;">
						<label style = "font-size:18px;" for = "bp">BP</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['BP']?></label>
					</div>
					<div class = "form-group" style = "width:15%; float:left;">
						<label style = "font-size:18px;" for = "temp">TEMP</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['TEMP']?></label>
					</div>
					<div class = "form-group" style = "width:15%; float:left;">	
						<label style = "font-size:18px;" for = "pr">PR</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['RR']?></label>
					</div>
					<div class = "form-group" style = "width:15%; float:left;">	
						<label style = "font-size:18px;" for = "rr">RR</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['RR']?></label>
					</div>
					<div class = "form-group" style = "width:15%; float:left;">	
						<label style = "font-size:18px;" for = "wt">Weight</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['Weight']?></label>
					</div>	
					<div class = "form-group" style = "width:15%; float:left;">	
						<label style = "font-size:18px;" for = "ht">Height</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['Height']?></label>
					</div>
					<br />
					<br style = "clear:both;"/>
				<hr style = "border:1px dotted #d3d3d3;" />
				<div class = "form-inline">
					<label>Date of Request:</label>
					<input type = "text" value = "<?php echo date("m/d/Y", strtotime("+8 HOURS"))?>" name = "date_of_request" class = "form-control" readonly = "readonly"/>
				</div>
				<br />
                <div class = "form-inline">
					<h4 style = "color:#3C763D;"><b>Sample Lab Test</b></h4>
					<br />

                    <input type="checkbox" id="CBC" name="CBC" value="YES">
                    <label for="CBC"> CBC With Platelet Count / CBC</label><br>
                    <input type="checkbox" id="BloodTyping" name="BloodTyping" value="YES">
                    <label for="BloodTyping"> Blood Typing</label><br>
                    <input type="checkbox" id="ClottingTime" name="ClottingTime" value="YES">
                    <label for="ClottingTime"> Clotting Time</label><br>
                    <input type="checkbox" id="BLEEDINGTIME" name="BLEEDINGTIME" value="YES">
                    <label for="BLEEDINGTIME"> BLEEDING TIME</label><br>
                    <input type="checkbox" id="HBA1C" name="HBA1C" value="YES">
                    <label for="HBA1C"> HBA1C</label><br>
                    <input type="checkbox" id="FBS/RBS" name="FBSandRBS" value="YES">
                    <label for="FBS/RBS"> FBS/RBS</label><br>
                    <input type="checkbox" id="LIPIDPROFIlE" name="LIPIDPROFIlE" value="YES">
                    <label for="LIPIDPROFIlE"> LIPID PROFIlE</label><br>
                    <input type="checkbox" id="TOTALCHOLESTEROL" name="TOTALCHOLESTEROL" value="YES">
                    <label for="TOTALCHOLESTEROL"> TOTAL CHOLESTEROL</label><br>
                    <input type="checkbox" id="TRIGLYCERIDES" name="TRIGLYCERIDES" value="YES">
                    <label for="TRIGLYCERIDES"> TRIGLYCERIDES</label><br>
                    <input type="checkbox" id="BLOODUREANITROGEN" name="BLOODUREANITROGEN" value="YES">
                    <label for="BLOODUREANITROGEN"> BLOOD UREA NITROGEN</label><br>
                    <input type="checkbox" id="CREATININE" name="CREATININE" value="YES">
                    <label for="CREATININE"> CREATININE</label><br>
                    <input type="checkbox" id="BLOODURICACID" name="BLOODURICACID" value="YES">
                    <label for="BLOODURICACID"> BLOOD URIC ACID</label><br>
                    <input type="checkbox" id="SGPT/ALT" name="SGPTandALT" value="YES">
                    <label for="SGPT/ALT"> SGPT / ALT</label><br>
                    <input type="checkbox" id="SGOT/AST" name="SGOTandAST" value="YES">
                    <label for="SGOT/AST"> SGOT / AST</label><br>
                    <input type="checkbox" id="ALBUMIN" name="ALBUMIN" value="YES">
                    <label for="ALBUMIN"> ALBUMIN</label><br>
                    <input type="checkbox" id="SODIUM" name="SODIUM" value="YES">
                    <label for="SODIUM"> SODIUM</label><br>
                    <input type="checkbox" id="POTASSIUM" name="POTASSIUM" value="YES">
                    <label for="POTASSIUM"> POTASSIUM</label><br>
                    <input type="checkbox" id="HBSAG" name="HBSAG" value="YES">
                    <label for="HBSAG"> HBSAG</label><br>
                    <input type="checkbox" id="VDRL" name="VDRL" value="YES">
                    <label for="VDRL"> VDRL</label><br>
                    <input type="checkbox" id="URINALYSIS" name="URINALYSIS" value="YES">
                    <label for="URINALYSIS"> URINALYSIS</label><br>
                    <input type="checkbox" id="PREGNANCYTEST" name="PREGNANCYTEST" value="YES">
                    <label for="PREGNANCYTEST"> PREGNANCY TEST</label><br>
                    <input type="checkbox" id="FECALYSIS" name="FECALYSIS" value="YES">
                    <label for="FECALYSIS"> FECALYSIS</label><br>


				</div>
                <br>
                <br>
				<div class = "form-inline">
					<button class = "btn btn-primary" name = "save_test" ><span class = "glyphicon glyphicon-save"></span> SAVE</button> 

				<a style = "float:right; margin-top:-4px;" href = "findings.php?itr_no=<?php echo $_GET['itr_no']?>" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> findings</a>

				</div>
			
			</div>
			<?php require 'add_query.php'?>
			</form>
		</div>
		 
	</div>
	<div id = "footer">
		<label class = "footer-title"></label>
	</div>
	</body>
		<?php require "script.php" ?>
</html>