<?php 
	session_start();
	if($_SESSION['user']){
		$user=$_SESSION['user'];
	}
	else{
		header("location:index.php");
	}
		
$con=mysqli_connect("localhost","root","","atm") or die(mysqli_error());

	$balance=0.00;
	$query=mysqli_query($con,"SELECT * from Passbook WHERE user='$user'");
	while($row=mysqli_fetch_array($query))
		{
			$balance= $balance + $row['amount'];
		}

	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		date_default_timezone_set("Africa/Kampala");
		$amount=($_POST['amount']);

		
		if($amount>$balance)
		{
			
			Print '<script>alert("You do not have sufficient Funds.");;
			window.location.assign("balance.php")</script>';
			exit("You have insufficient funds!");
			//header("location: balance.php");
			
		}
		$amount=(-$amount);
		$details=($_POST['details']);
		$time = strftime("%T");
		$date = strftime("%B %d, %Y");

		mysqli_query($con,"INSERT INTO Passbook (amount,date_transaction,details,user) VALUES ('$amount','$date','$details','$user')");
		Print '<script>alert("Successful Withdrawal.");window.location.assign("balance.php");</script>';
		
	}
	else
	{
		header("location:home.php");
	}


 ?>
