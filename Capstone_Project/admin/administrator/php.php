<?php

$pdo = require '../database/connV2.php';

if (isset($_POST['additemBtn'])) {
	$supplier_id = $_POST['supplier_id'];
	$brand = $_POST['brand'];
	$product_name = $_POST['product_name'];  
	$imageData = file_get_contents($_FILES["imageUpload"]["tmp_name"]);
	$product_desc = $_POST['product_desc'];
	$category = $_POST['category'];
	$price = $_POST['price'];
	$discount = $_POST['discount'];
	$stock = $_POST['stock'];
	$expiry_date = $_POST['expiry_date'];
  
	insertList1($pdo, $supplier_id, $brand, $product_name, $imageData, $product_desc, $category, $price, $discount, $stock, $expiry_date);
	echo '<script>window.location="item_list.php"</script>';
	unset($_POST['additemBtn']);
  }
  
  function insertList1($pdo, $supplier_id, $brand, $product_name, $imageData, $product_desc, $category, $price, $discount, $stock, $expiry_date) {
	try {
		// Prepare and execute the SQL query to insert the image and product_name into the database
		$sql = "INSERT INTO Product (product_name, supplier_id, image, product_desc, category, price, discount, stock, expiry_date, brand) 
		VALUES (:product_name, :supplier_id, :image, :product_desc, :category, :price, :discount, :stock, :expiry_date, :brand)";
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':product_name', $product_name);
		$statement->bindValue(':supplier_id', $supplier_id);
		$statement->bindValue(':image', $imageData, PDO::PARAM_LOB);
		$statement->bindValue(':product_desc', $product_desc);
		$statement->bindValue(':category', $category);
		$statement->bindValue(':price', $price);
		$statement->bindValue(':discount', $discount);
		$statement->bindValue(':stock', $stock);
		$statement->bindValue(':expiry_date', $expiry_date);
		$statement->bindValue(':brand', $brand);
		$statement->execute();
  
		// You can add more code here if needed after the insertion.
		echo '<script>alert("New Item Add Successfully")</script>';
	} catch (Exception $e) {
		echo 'Message: ' . $e->getMessage();
	}
 }

 




// Insert Supplier


if (isset($_POST['addSupplierBtn'])) {
	$supplier_name = $_POST['supplier_name'];
	$contact_person = $_POST['contact_person'];
	$number = $_POST['number'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	insertSupplier($pdo,$supplier_name,$contact_person,$number,$telephone,$email);
	echo '<script>window.location="supplier.php"</script>';
	unset($_POST['addSupplierBtn']);  
  }
  
  function insertSupplier($pdo,$supplier_name,$contact_person,$number,$telephone,$email){
	try {
		$sql ='INSERT INTO supplier (supplier_name, contact_person, number, telephone, email) 
		values (:supplier_name, :contact_person, :number, :telephone, :email)';
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':supplier_name',$supplier_name);
		$statement->bindValue(':contact_person',$contact_person); 
		$statement->bindValue(':number',$number); 
		$statement->bindValue(':telephone',$telephone); 
		$statement->bindValue(':email',$email); 
		$statement->bindValue(':telephone',$telephone); 
		$statement->execute();
  
		echo '<script>alert("New Supplier Add Successfully")</script>';
	}catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
	}
	$pdo = null;
	$sql = null;
  }







  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['supplier_id'])) {
        $conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());

        $supplierId = $_POST['supplier_id'];
        
        // Perform the deletion query here
        $query = $conn->query("DELETE FROM `supplier` WHERE `supplier_id` = '$supplierId'") or die(mysqli_error());

        if ($query) {
            echo "success";
        } else {
            echo "error";
        }

        $conn->close();
    }
}

//update Supplier



if (isset($_POST['edit_supplier'])) {
    $supplier_id = $_GET['id']; // Get the supplier ID from the URL
    $supplier_name = $_POST['supplier_name'];
    $contact_person = $_POST['contact_person'];
    $number = $_POST['number'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    UpdateSupplier($pdo, $supplier_id, $supplier_name, $contact_person, $number, $telephone, $email);
}

  
 

  
  
  
  function UpdateSupplier($pdo, $supplier_id, $supplier_name, $contact_person, $number, $telephone, $email){
	try {
		$sql ='UPDATE Supplier SET supplier_name = :supplier_name, contact_person = :contact_person, number = :number, telephone = :telephone, email = :email
		WHERE supplier_id = :supplier_id;';
		$statement = $pdo->prepare($sql);
		$statement->bindValue(':supplier_id',$supplier_id);
		$statement->bindValue(':supplier_name',$supplier_name);
		$statement->bindValue(':contact_person',$contact_person);
		$statement->bindValue(':number',$number);
		$statement->bindValue(':telephone',$telephone);
		$statement->bindValue(':email',$email);
		$statement->execute();
		echo '<script>alert(" Supplier successfully updated")</script>';
		echo '<script>window.location="supplier.php"</script>';
	}catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
	
		$pdo = null;
		$sql = null;
	}
  
  }
  






//

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        $conn = new mysqli("localhost", "root", "", "capstonedbdraft") or die(mysqli_error());

        $productId = $_POST['product_id'];
        
        // Perform the deletion query here
        $query = $conn->query("DELETE FROM `product` WHERE `product_id` = '$productId'") or die(mysqli_error());

        if ($query) {
            echo "success";
        } else {
            echo "error";
        }

        $conn->close();
    }
}



?>