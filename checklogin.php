<?php 
	session_start();
	$username=$_POST['username'];
	$password=$_POST['password'];

	$con=mysqli_connect("localhost","root","","atm") or die(mysqli_error());
	$query=mysqli_query($con,"SELECT * FROM users WHERE username = '$username'");
	$exists=mysqli_num_rows($query);
	$table_user="";
	$table_password="";
	if($exists>0)
	{
		while($row=mysqli_fetch_array($query))
		{
			$table_user=$row['username'];
			$table_password=$row['password'];
		}
		if($username== $table_user)
		{
			if($password==$table_password)
			{
				$_SESSION['user']= $username;
				header("location:home.php");
			}
			else
			{
				Print '<script>alert("Incorrect Password!");</script>';
				Print '<script>window.location.assign("login.php");</script>';
			}
		}
	}
	else
	{
		Print '<script>alert("Incorrect Username!");</script>';
		Print '<script>window.location.assign("login.php");</script>';
	}

 ?>