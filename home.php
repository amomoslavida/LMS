<?php
	session_start();
	if( $_SESSION["user"] == true ){
		
		
	
	if($_SESSION['id'] != 1){
			header("Location: reservations2.php");
			return;
			}
	
	
	
	
	include_once("db.php");

	ob_start();
	}
	else{
		header("Location: login.php");
		return;
	}
	 
	

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style>

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
	
}#head1{
		background-image: url('library.jpg');
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
  }
  
  table.cinereousTable {
  font-family: Arial, Helvetica, sans-serif;
  border: 6px solid black;
  background-color: #c7e0e2;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.cinereousTable td, table.cinereousTable th {
  border: 1px solid black;
  padding: 4px 4px;
}
table.cinereousTable tbody td {
  font-size: 14px;
}
table.cinereousTable thead {
  background: linear-gradient(to bottom, #919191 0%,#5fb1b7 75%, #241235 100%);
}
table.cinereousTable thead th {
  font-size: 17px;
  font-weight: bold;
  color: black;
  text-align: left;
  border-left: 2px solid black;
}
table.cinereousTable thead th:first-child {
  border-left: none;
}

table.cinereousTable tfoot {
  font-size: 16px;
  font-weight: bold;
  color: #F0F0F0;
  background: gray;
  background: -moz-linear-gradient(top, #919191 0%, #e8e8e8 75%, LightBlue 100%);
  background: -webkit-linear-gradient(top, #919191 0%, #e8e8e8 75%, LightBlue 100%);
  background: linear-gradient(to bottom, #919191 0%, #e8e8e8 75%, LightBlue 100%);
}
table.cinereousTable tfoot td {
  font-size: 16px;
}

#mod-user{
	width: 400px;
}

body{
	font-family: Arial, Helvetica, sans-serif;
}


.collapsible {
    background-color: #5fb1b7
;
    color: white;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
}

.active, .collapsible:hover {
    background-color: #94a6a8;
}

.content {
    padding: 0 18px;
    display: none;
    overflow: hidden;
    background-color: #F0F8FF;
}

* {
    box-sizing: border-box;
}


/* Style the header */
.header {
  grid-area: header;
  background-color: #F0F8FF;
  padding: 30px;
  text-align: center;
  font-size: 35px;
}
  
</style>
</head>
<body>
<div class="grid-container">
  <div class="header" id="head1" >
    <h1 style="color:white;cursor:pointer;" onclick="window.location.href='home.php'">Library Management System</h1>
  </div>

<ul>
  <li><a style="color:white;cursor:pointer;"  class="active" onclick="window.location.href='home.php'">Users</a></li>
  <li><a style="color:white;cursor:pointer;"  onclick="window.location.href='books.php';">Books</a></li>
  <li><a style="color:white;cursor:pointer;"  onclick="window.location.href='reservations.php';">Reservation</a></li>
  <li><a style="color:white;cursor:pointer;"  onclick="window.location.href='logout.php'">Log Out</a></li>
 
</ul>
 <div class="middle">
  <h2>Users</h2>
  
  <table class="cinereousTable">
	<thead>
		<tr>
			<th> userID </th>
			<th> username </th>
			<th> name </th>
			<th> surname </th>
			<th> TC </th>
			<th> phone </th>
			<th> email </th>
		</tr>
	</thead>
	<tbody>
	<?php
	//select all from users where user is not admin(userID = 1)
	$sql = "SELECT * FROM users
			WHERE userID !='1'
			ORDER BY userID ASC
			
			
			";

	
	$res = mysqli_query($db, $sql) or die(mysqli_error($db));
	
	$post = "";
	
	if(mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_assoc($res)){
			$userID = $row['userID'];
			$username = $row['username'];
			$name = $row['name'];
			$surname = $row['surname'];
			$TC = $row['TC'];
			$phone = $row['phone'];
			$email = $row['email'];
			
			
			
			$post .=  "
							<tr>
								<td class='userID'> $userID </td>
								<td class='username'> $username </td>
								<td class='name'> $name </td>
								<td class='surname'> $surname </td>
								<td class='TC'> $TC </td>
								<td class='phone'> $phone </td>
								<td class='email'> $email </td>
							</tr>
						";
		}
		echo $post;
	
	}
	else{
		echo "
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
		
		";
	}
	
?>
</tbody>
</table>
<br />
		<div id="mod-user">
		
		
		
			<button class="collapsible">Register User</button>
			<div class="content" style="text-align:left;">
				<form accept-charset= "utf-8" action="home.php" method="post">
					<table class="cinereousTable">
						<tr>
							<td>Username</td>
							<td><input name="username_reg" type="text" cols="50"></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input  name="password_reg" type="password" cols="50">
						</tr>
						<tr>	
							<td>Name</td>
							<td><input name="name_reg" type="text" cols="50"></td>
						</tr>
						<tr>
							<td>Surname</td>
							<td><input name="surname_reg" type="text" cols="50"></td>
						</tr>
						<tr>
							<td>TC</td>
							<td><input placeholder="11 digit ID" name="TC_reg" type="text" cols="50" maxlength="11"></td>
						</tr>					
						<tr>
							<td>Phone</td>
							<td><input placeholder="10 digit phone" name="phone_reg" type="text" cols="50" maxlength="10"></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input placeholder="email@email.com" name="email_reg" type="text" cols="50"></td>
						</tr>				
					</table>
					<div  style="padding-top:5px;padding-bottom:5px;">
						<input name="registerUser" type="submit" value="Register" style="padding:4px;padding-left:6px;padding-right:6px;">
					</div>
				</form>
			</div>
			
			
			
			
			
		
			<button class="collapsible">Delete User</button>
			<div class="content">
				<form action="home.php" method="post">
					<div  style="padding-top:5px;padding-bottom:5px;">
						<table style="width:100%;">
							<tr>
								<td>
								User: 
								</td>
								
								<td>
								<select name="userID2" style="width:72%">
							<?php
							
							$sql_del = "SELECT userID, name, surname FROM users WHERE userID != '1' ORDER BY userID ASC";
	
							$res = mysqli_query($db, $sql_del) or die(mysqli_error($db));
							
							$options4 = "";
							while($row = mysqli_fetch_assoc($res)){
								$userID2 = $row['userID'];
								$name2 = $row['name'];
								$surname2 = $row['surname'];
			
			
								$options4 .=  "
											
												<option value='$userID2'>ID: $userID2, $name2, $surname2 </option>
											
										";
							}
							echo $options4;
							
								?>
								</select>
								<input name="deleteUser" type="submit" value="Delete">
								</td>
							</tr>
					</table>
					</div>
				</form>
			</div>
			
			
			
			
			
			
			
			<button class="collapsible">Edit User</button>
			<div class="content">
				<form action="home.php" method="post">
					<div  style="padding-top:5px;padding-bottom:5px;">
						<table style="width:100%;">
						<tr>
								<td>
								User:
								</td>
								<td>
								<select name="userID3" style="width:72%">
							<?php
							
							$sql = "SELECT userID, name, surname FROM Users WHERE userID !='1' ORDER BY userID ASC";
	
							$res = mysqli_query($db, $sql) or die(mysqli_error($db));
							
							$options = "";
							while($row = mysqli_fetch_assoc($res)){
								$userID3 = $row['userID'];
								$name3 = $row['name'];
								$surname3 = $row['surname'];
			
			
								$options .=  "
											
												<option value='$userID3'>ID: $userID3, $name3, $surname3</option>
											
										";
							}
							echo $options;
							
								?>
								</select>
								</td>
							</tr>
							<tr>
								<td>
								Name: 
								</td>
								
								<td>
								<input name="name4" type="text" cols="50">
								
								</td>
							</tr>
							<tr>
								<td>
								Surname: 
								</td>
								
								<td>
								<input name="surname4" type="text" cols="50">
								</td>
							</tr>
							<tr>
								<td>
								TC: 
								</td>
								
								<td>
								<input name="TC4" type="text" cols="50" maxlength="11">
								</td>
							</tr>
							
							<tr>
								<td>
								Phone: 
								</td>
								
								<td>
								<input name="phone4" type="text" cols="50" maxlength="10">
								</td>
							</tr>
							<tr>
								<td>
								Email:
								</td>
								
								<td>
								<input name="email4" type="text" cols="50">
								</td>
							</tr>
							<tr>
								<td></td>
								<td><input name="editUser" type="submit" value="Edit"></td>
							</tr>
					</table>
					
					</div>
				</form>
			</div>
			
			
		</div>
  
  </div>  
  
</div>


</body>
</html>







<?php
//EDIT USER
if(isset($_POST['editUser'])){
		$userID3 = strip_tags($_POST['userID3']);
		$name4 = strip_tags($_POST['name4']);
		$surname4 = strip_tags($_POST['surname4']);
		$TC4 = strip_tags($_POST['TC4']);
		$phone4 = strip_tags($_POST['phone4']);
		$email4 = strip_tags($_POST['email4']);
		
		$sql = "	UPDATE Users
					SET name = '$name4',
						surname = '$surname4',
						TC = '$TC4',
						phone = '$phone4',
						email = '$email4'
					WHERE userID = '$userID3'
		";
		
	/*
	
	//CHECK IF A TEXTBOX IS EMPTY OR = ANY DESIRED VALUE
	
	if($emp_name == "") {
			
			function alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
			alert("please give name");
			header("Refresh:0");
			return;
		}		
		
		*/
		
		if (!mysqli_query($con,$sql3))
  {
  echo("Error description: " . mysqli_error($con));
  }

		
		mysqli_query($db, $sql);
		
		header("Refresh:0");
	}
?>




<?php
//DELETE USER
if(isset($_POST['deleteUser'])){
		$userID2 = strip_tags($_POST['userID2']);
		
		
		$sql = "DELETE FROM Users WHERE userID='$userID2'";
		
		mysqli_query($db, $sql);
		
		header("Refresh:0");
	}
?>

<?php
//ADD USER
if(isset($_POST['registerUser'])){
		$username_add = strip_tags($_POST['username_reg']);
		$password_add = strip_tags($_POST['password_reg']);
		$name_add = strip_tags($_POST['name_reg']);
		$surname_add = strip_tags($_POST['surname_reg']);
		$TC_add = strip_tags($_POST['TC_reg']);
		$phone_add = strip_tags($_POST['phone_reg']);
		$email_add = strip_tags($_POST['email_reg']);
		
		$password_add = md5($password_add);
	
		
		$sql3 = "INSERT into Users(username, password, name, surname, TC, phone, email)
		VALUES ('$username_add', '$password_add', '$name_add', '$surname_add', '$TC_add', '$phone_add', '$email_add')";
		
		if($username_add == "" || $password_add == "" || $TC_add == "") {
			
			function alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
			alert("Please fill username, password and TC");
			header("Refresh:0");
			return;
		}
		mysqli_query($db, $sql3);
		
		header("Refresh:0");
	}

?>

<?php
//LOGOUT
if(isset($_POST['logout'])){
		header("Location: logout.php");
	}
?>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
}

function reload() {
   $window.location.reload();
}

</script>

