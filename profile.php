<?php
	
	session_start();
	if( $_SESSION["user"] == true ){
		
	
	if($_SESSION['id'] == 1){
			header("Location: home.php");
			return;
			}
		$id =	$_SESSION['id'];
	
	
	
	
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

  <li><a style="color:white;cursor:pointer;"   onclick="window.location.href='reservations2.php';">My Reservations</a></li>
  <li><a  style="color:white;cursor:pointer;"  onclick="window.location.href='books2.php';">Books</a></li>
  <li><a style="color:white;cursor:pointer;"  class="active" onclick="window.location.href='profile.php';">My Profile</a></li>
  <li><a style="color:white;cursor:pointer;" onclick="window.location.href='logout.php'">Log Out</a></li>
 
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
	
	$sql = "SELECT * FROM users
			WHERE userID = '$id'
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
		
			
			
			
			
			
		
			
			
			
			
			
			
			
			
			<button class="collapsible">Edit Info</button>
			<div class="content">
				<form action="profile.php" method="post">
					<div  style="padding-top:5px;padding-bottom:5px;">
						<table style="width:100%;">
						<tr>
								<td>
								User: 
								</td>
								<td>
								<input name="userID" disabled type="text" cols="50" value= '<?php echo htmlspecialchars($id); ?>' >
								</td>
							</tr>
							<tr>
								<td>
								Name: 
								</td>
								
								<td>
								<input name="name4" type="text" cols="50" value =  '<?php echo htmlspecialchars( $_SESSION['name']); ?>' >
								
								</td>
							</tr>
							<tr>
								<td>
								Surname: 
								</td>
								
								<td>
								<input name="surname4" type="text" cols="50" value =  '<?php echo htmlspecialchars( $_SESSION['surname']); ?>'>
								</td>
							</tr>
							<tr>
								<td>
								TC: 
								</td>
								
								<td>
								<input name="TC4" type="text" cols="50" maxlength="11" value =  '<?php echo htmlspecialchars( $_SESSION['tc']); ?>'>
								</td>
							</tr>
							
							<tr>
								<td>
								Phone: 
								</td>
								
								<td>
								<input name="phone4" type="text" cols="50" maxlength="10" value =  '<?php echo htmlspecialchars( $_SESSION['phone']); ?>'>
								</td>
							</tr>
							<tr>
								<td>
								Email:
								</td>
								
								<td>
								<input name="email4" type="text" cols="50" value =  '<?php echo htmlspecialchars( $_SESSION['email']); ?>' >
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
					WHERE userID = '$id'
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
		
		
		
		mysqli_query($db, $sql);
		
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

