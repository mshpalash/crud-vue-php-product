	<?php

	$conn=new mysqli("localhost","root","","topstar");

	if ($conn->connect_error) {
		die("Connection Failed!".$conn->connect_error);
	}

	$result= array('error' => false );

	$action='';

	if (isset($_GET['action'])) {
		$action=$_GET['action'];
	}

	if ($action=='read') {
		$sql=$conn->query("select * from products");
		$Products = array();
		while ($row=$sql->fetch_assoc()) {
			array_push($Products, $row);
		}
		$result['Products']=$Products;
	}

	if ($action=='create') {

		$Title=$_POST['Title'];
		$Description=$_POST['Description'];
		$Price=$_POST['Price'];
		$Image=$_POST['Image'];

		$sql=$conn->query("insert into products (Title,Description,Price,Image) values ('$Title','$Description','$Price','$Image')");

	if ($sql) {
		$result['message']="product added successfully!";
	}
	else
	{
		$result['error']=true;
		$result['message']="Failed to add product!";
	}
	}

	if ($action=='update') {

		$id=$_POST['id'];
		$Title=$_POST['Title'];
		$Description=$_POST['Description'];
		$Price=$_POST['Price'];
		$Image=$_POST['Image'];

		$sql=$conn->query("update products set Title='$Title',Description='$Description',Price='$Price',Image='$Image' where id='$id'");

	if ($sql) {
		$result['message']="product Update successfully!";
	}
	else
	{
		$result['error']=true;
		$result['message']="Failed to Update product!";
	}
	}

	if ($action=='delete') {

		$id=$_POST['id'];

		$sql=$conn->query("delete from products where id='$id'");

	if ($sql) {
		$result['message']="product delete successfully!";
	}
	else
	{
		$result['error']=true;
		$result['message']="Failed to delete product!";
	}
	}

	$conn->close();

	echo json_encode($result);
	?>