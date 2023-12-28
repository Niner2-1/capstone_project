<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "capstonedbdraft";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}