<?php 
	session_start();
	if($_SESSION['user']){
		$user=$_SESSION['user'];
	}
	else{
		header("location:index.php");
	}
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		date_default_timezone_set("Africa/Kampala");
		$amount=($_POST['amount']);
		$details=($_POST['details']);
		$time = strftime("%T");
		$date = strftime("%B %d, %Y");
	    $con=mysqli_connect("localhost","root","","atm") or die(mysqli_error());
		mysqli_query($con,"INSERT INTO Passbook (amount,date_transaction,details,user) VALUES ('$amount','$date','$details','$user')");
		Print '<script>alert("Successful Deposit Made.");window.location.assign("balance.php");</script>';
	
	}
	else
	{
		header("location:home.php");
	}


 ?>
