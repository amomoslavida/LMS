<?php
	if(isset($_SESSION['id'])){
		
		if($_SESSION['id'] != 1){
			header("Location: books2.php");
		}
		header("Location: home.php");
	}
	
	
	if(isset($_POST['register'])){
		include_once("db.php");
	
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$password_confirm = strip_tags($_POST['password_confirm']);
		$email = strip_tags($_POST['email']);
		$name = strip_tags($_POST['name']);
		$surname = strip_tags($_POST['surname']);
		$tc = strip_tags($_POST['tc']);
		$phone = strip_tags($_POST['phone']);
		
		
		$username = stripslashes($username);
		$password = stripslashes($password);
		$password_confirm = stripslashes($_POST['password_confirm']);
		$email = stripslashes($_POST['email']);
		$name = stripslashes($_POST['name']);
		$surname = stripslashes($_POST['surname']);
		$tc = stripslashes($_POST['tc']);
		$phone = stripslashes($_POST['phone']);
		
		
		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);
		$password_confirm = mysqli_real_escape_string($db, $password_confirm);
		$email = mysqli_real_escape_string($db, $email);
		$name = mysqli_real_escape_string($db, $name);
		$surname = mysqli_real_escape_string($db, $surname);
		$tc = mysqli_real_escape_string($db, $tc);
		$phone = mysqli_real_escape_string($db, $phone);
	
		$password = md5($password);    // password should encrypted to send db, security issues
		$password_confirm = md5($password_confirm);
		
		$sql_store = "  INSERT into users(username, password, name, surname, TC, phone, email)
						VALUES ('$username', '$password', '$name', '$surname', '$tc', '$phone', '$email')
						";
						
		$sql_fetch_username = "SELECT username FROM users WHERE username = '$username'";
		$sql_fetch_email = "SELECT email FROM users WHERE email = '$email'";
		
		$query_username = mysqli_query($db, $sql_fetch_username);
		$query_email = mysqli_query($db, $sql_fetch_email);
		
		function alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
		
		
		if(mysqli_num_rows($query_username)){
			alert("Username is already in use");
			header("Refresh:0");
			return;
		}
		if(mysqli_num_rows($query_email)){
			alert("Email is already in use");
			header("Refresh:0");
			return;
		}
		if($username == ""){
			alert("Please insert a username");
			header("Refresh:0");
			return;
		}
		if($password == "" || $password_confirm == ""){
			alert("Please insert your password");
			header("Refresh:0");
			return;
		}
		if($password != $password_confirm){
			alert("The passwords do not match");
			header("Refresh:0");
			return;
		}
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == ""){
			alert("Invalid email");
			header("Refresh:0");
			return;
		}
		mysqli_query($db, $sql_store);
		$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['tc'] = $tc;
			$_SESSION['email'] = $email;
			$_SESSION['phone'] = $phone;
			$_SESSION['password'] = $session_password;
		header("Location: home.php");
		
	}
?>

  <style>
  #head1{
		background-image: url('library.jpg');
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		text-align:center;
  }
  
  .middle{
	  text-align:center;
  }
  
  #login-tbl{
	  position: absolute;
  }
  
  input{
		height: 30px;
		padding-left:5px;
		padding-right:5px;
  }
  
  #lgn{
	  width:65px;
  }
  
  button{
	  height: 30px;
	  width: 65px;
		padding-left:5px;
		padding-right:5px;
  }
  
  body{
	  background-color: #F2F2F2;
  }
  </style>


<!DOCTYPE html>
<html>
<head>
	<title>LMS-Register</title>
</head>
<body>
	<div class="grid-container">
		<div class="header" id="head1" onclick="window.location.href='home.php'" style="cursor:pointer;">
			<h1 style="color:white;">Library Management System</h1>
		</div>



		<div class="middle" style="background-color:style="background-color:#948473;";">
			<h2 id="login">Register</h2>
			<form action="register.php" method="post" enctype="multipart/form-data">
			<tr>
				<td>
					<input placeholder="Username" name="username" type="text" autofocus><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<input placeholder="Password" name="password" type="password"><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<input placeholder="Confirm Password" name="password_confirm" type="password"><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<input placeholder="E-Mail Address" name="email" type="text"><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<input placeholder="Name" name="name" type="text"><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<input placeholder="Surname" name="surname" type="text"><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<input placeholder="TC" name="tc" type="text" maxlength="11"><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<input placeholder="10 digit" name="phone" type="text" maxlength="10"><br /><br />
				</td>
			</tr>
		
				<input name="register" type="submit" value="Register" id="lgn">
			</form>
		</div>  



</div>

	
		
</body>
</html>