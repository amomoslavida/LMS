<?php
	session_start();
	if(isset($_POST['login'])){
		include_once("db.php");
		
	   
		$username = strip_tags($_POST['username']);	//to prevent SQL injection
		$password = strip_tags($_POST['password']);
		
		$username = stripslashes($username);
		$password = stripslashes($password);
		
		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);
		
		$session_password = $password;
		
		$password = md5($password);
		
		$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($query);
		$id = $row['userID'];
		$db_password = $row['password'];
		$name = $row['name'];
		$surname = $row['surname'];
		$tc = $row['TC'];
		$phone = $row['phone'];
		$email = $row['email'];
		
		
		if($password == $db_password){
			 $_SESSION["user"] = true;
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['surname'] = $surname;
			$_SESSION['tc'] = $tc;
			$_SESSION['email'] = $email;
			$_SESSION['phone'] = $phone;
			$_SESSION['password'] = $session_password;
			
			if($_SESSION['id'] == 1){
			header("Location: home.php");
			return;
			}
			if($_SESSION['id'] != 1){
			header("Location: books2.php");
			return;
			}
		}
		else{
			function alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
			alert("Username or Password is incorrect");
		//	header("Refresh:0");
		
		}
	}
	

	
	
	
	

?>




<!DOCTYPE html>
<html>
<head>
	<title>LMS-Login</title>
</head>

<body>

<div class="grid-container">
  <div class="header" id="head1" >
    <h1 style="color:white;cursor:pointer;" onclick="window.location.href='home.php'">Library Management System</h1>
  </div>
  
  <style>
  /* Style the header */
.header {
  grid-area: header;
  background-color: #F0F8FF;
  padding: 30px;
  text-align: center;
  font-size: 35px;
}
  </style>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

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
  <div class="middle" style="background-color:style="background-color:#948473;";">
	<h2 id="login">LOGIN</h2>
	<form action="login.php" method="post" enctype="multipart/form-data">
	
		
			<input placeholder="Username" name="username" type="text" autofocus><br /><br />
		
			<input placeholder="Password" name="password" type="password"><br /><br />
		
			<input name="login" type="submit" value="Login" id="lgn"><br /><br />
		
			<button type="button" onclick="window.location.href='register.php'">Register</button>
	</form>
  
  </div>  
  
 
  
  
  
  
<!--  <div class="right" style="background-color:#ccc;">Column</div> -->
  
</div>




</body>
</html>






<!--


	<form action="login.php" method="post" enctype="multipart/form-data">
		<input placeholder="Username" name="username" type="text" autofocus>
		<input placeholder="Password" name="password" type="password">
		<input name="login" type="submit" value="Login">
	</form>


-->


