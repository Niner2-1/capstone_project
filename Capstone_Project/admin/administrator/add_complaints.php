<?php
    if (isset($_POST['save_complaints'])) {
        $conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());

        // Sanitize user inputs before using them in queries
        $complaints = $conn->real_escape_string($_POST['complaints']);
        $remarks = $conn->real_escape_string($_POST['remarks']);

        $bp = $conn->real_escape_string($_POST['bp']);
        $temp = $conn->real_escape_string($_POST['temp']) . "°C";
        $hr = $conn->real_escape_string($_POST['pr']);
        $rr = $conn->real_escape_string($_POST['rr']);
        $weight = $conn->real_escape_string($_POST['weight']) . "kg";
        $height = $conn->real_escape_string($_POST['height']) . "cm";

        // Assuming you get id and lastname from somewhere in your code
        $id = $conn->real_escape_string($_GET['id']);
        $lastname = $conn->real_escape_string($_GET['lastname']);

        // Fetch the itr_no from patient records
        $q = $conn->query("SELECT * FROM `Patient_record` WHERE `itr_no` = '$id' && `lastname` = '$lastname'") or die(mysqli_error());
        $f = $q->fetch_array();
        $itr_no = $f['itr_no']; // Assuming the column name is 'itr_no'

        // Insert data into complaints table
        $date = date('m/d/Y', strtotime('+8 HOURS'));
        $query = "INSERT INTO `complaints` (`itr_no`, `date`, `BP`, `TEMP`, `HR`, `RR`, `Weight`, `Height`, `complaints`, `remark`, `status`) 
                  VALUES ('$itr_no', '$date', '$bp', '$temp', '$hr', '$rr', '$weight', '$height', '$complaints', '$remarks', 'Pending')";
        $conn->query($query) or die(mysqli_error());

        echo("<script> location.replace('patient.php');</script>");
        
        $conn->close();
    }
?>
