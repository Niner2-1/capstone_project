<?php
	$id = $_GET['id'];
	$last = $_GET['lastname'];
	if(ISSET($_POST['edit_patient'])){
		$family_no = $_POST['family_no'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$birthdate = $_POST['month']."/".$_POST['day']."/".$_POST['year'];
		$age = $_POST['age'];
		$phil_health_no = $_POST['phil_health_no'];
		$address = $_POST['address'];
		$civil_status = $_POST['civil_status'];
		$gender = $_POST['gender'];
		$bp = $_POST['bp'];
		$temp = $_POST['temp'];
		$pr = $_POST['pr'];
		$rr = $_POST['rr'];
		$wt= $_POST['wt'];
		$ht = $_POST['ht'];
		$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
		$conn->query("UPDATE `itr` SET `family_no` = '$family_no', `phil_health_no` = '$phil_health_no', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname', `birthdate` = '$birthdate', `age` = '$age', `address` = '$address', `civil_status` = '$civil_status', `gender` = '$gender', `BP` = '$bp', `TEMP` = '$temp', `PR` = '$pr', `RR` = '$rr', `WT` = '$wt', `HT` = '".addslashes($ht)."' WHERE `itr_no` = '$id' && `lastname` = '$last'") or die(mysqli_error());
		echo("<script> location.replace(' patient.php');</script>");
	}
	if(ISSET($_POST['edit_admin'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
			$conn->query("UPDATE `admin` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname' WHERE `admin_id` = '$id'") or die(mysqli_error());
			echo("<script> location.replace(' admin.php');</script>");
		}
	if(ISSET($_POST['edit_user'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());
			$conn->query("UPDATE `users` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname' WHERE `user_id` = '$id'") or die(mysqli_error());
			echo("<script> location.replace(' doctor.php');</script>");
		}
		
		
	
