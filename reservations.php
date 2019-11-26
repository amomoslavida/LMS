<?php
	session_start();
	
	
	if( $_SESSION["user"] == true ){
		
		
	
	if($_SESSION['id'] != 1){
			header("Location: reservations2.php");
			return;
			}
			else $id=$_SESSION['id'];
	
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
    background-color: 
#94a6a8
;
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
  <li><a  style="color:white;cursor:pointer;"  onclick="window.location.href='home.php'">Users</a></li>
  <li><a style="color:white;cursor:pointer;"  onclick="window.location.href='books.php';">Books</a></li>
  <li><a style="color:white;cursor:pointer;"  class="active" onclick="window.location.href='reservations.php';">Reservation</a></li>
  <li><a style="color:white;cursor:pointer;"  onclick="window.location.href='logout.php'">Log Out</a></li>
 
</ul>

  <div class="middle">
  <h2>Reservations</h2>
  
  <table class="cinereousTable">
	<thead>
		<tr>
			<th> Reservation ID </th>
			<th> Book ID </th>
			<th> Book Name </th>
			<th> User Id </th>
			<th> Date of Reservation </th>

		</tr>
	</thead>
	<tbody>
<?php
	$sql = "SELECT resID, bookID, userID, reservedate
			FROM reserves
			ORDER BY resID ASC
			";

	
	$res = mysqli_query($db, $sql) or die(mysqli_error($db));
	
	$post = "";
	
	if(mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_assoc($res)){
			$resID = $row['resID'];
			$bookID = $row['bookID'];
			$userID = $row['userID'];
			$dateofreserve = $row['reservedate'];
			$bookName = "";
			
			$sql2 = "SELECT name 
			FROM books
			WHERE bookID = '$bookID'
			";
			$res2 = mysqli_query($db, $sql2) or die(mysqli_error($db));
			
			if(mysqli_num_rows($res2) > 0){
		while($row2 = mysqli_fetch_assoc($res2)){
			$bookName =$row2['name'];
			}}
			
			
			$post .=  "
							<tr>
								<td> $resID </td>
								<td> $bookID </td>
								<td> $bookName </td>
								<td> $userID </td>
								<td> $dateofreserve </td>
								
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
				</tr>
		
		";
	}
	
?>



	</tbody>
</table>
<br />
		<div id="mod-user">
		
		
		
			<button class="collapsible">Add Reservation</button>
			<div class="content" style="text-align:left;">
				<form action="reservations.php" method="post">
					<table class="cinereousTable">
						<tr>
								<td>
								Book: 
								</td>
								
								<td>
								<select name="bookID_reg" style="width:72%">
							<?php
							
							$sql = "SELECT bookID, name FROM books WHERE numberofcopies != 0 ORDER BY name ASC";
	
							$res = mysqli_query($db, $sql) or die(mysqli_error());
							
							$options3 = "";
							while($row = mysqli_fetch_assoc($res)){
								$book_id = $row['bookID'];
								$book_name = $row['name'];
			
			
								$options3 .=  "
											
												<option value='$book_id'>id: $book_id, $book_name</option>
											
										";
							}
							echo $options3;
							
								?>
								</select>
								</td>
							</tr>
						<tr>
								<td>
								User: 
								</td>
								
								<td>
								<select name="userID_reg" style="width:72%">
							<?php
							
							$sql = "SELECT userID, name, surname FROM users WHERE userID !='1'  ORDER BY name ASC";
	
							$res = mysqli_query($db, $sql) or die(mysqli_error());
							
							$options3 = "";
							while($row = mysqli_fetch_assoc($res)){
								$user_id = $row['userID'];
								$user_name = $row['name'];
								$user_surname = $row['surname'];
			
			
								$options3 .=  "
											
												<option value='$user_id'>id: $user_id, $user_name $user_surname</option>
											
										";
							}
							echo $options3;
							
								?>
								</select>
								</td>
							</tr>
					</table>
					<div  style="padding-top:5px;padding-bottom:5px;">
						<input name="addReservation" type="submit" value="Reserve" style="padding:4px;padding-left:6px;padding-right:6px;">
					</div>
				</form>
			</div>
			
			
			
			
			
		
			<button class="collapsible">Delete Reservation</button>
			<div class="content">
				<form action="reservations.php" method="post">
					<div  style="padding-top:5px;padding-bottom:5px;">
						<table style="width:100%;">
							<tr>
								<td>
								Reservation: 
								</td>
								
								<td>
								<select name="resID2" style="width:72%">
							<?php
							
							$sql_del = "SELECT resID FROM reserves ORDER BY resID ASC";
	
							$res = mysqli_query($db, $sql_del) or die(mysqli_error($db));
							
							$options4 = "";
							while($row = mysqli_fetch_assoc($res)){
								$resID2 = $row['resID'];
			
			
								$options4 .=  "
											
												<option value='$resID2'>ID: $resID2</option>
											
										";
							}
							echo $options4;
							
								?>
								</select>
								<input name="deleteReservation" type="submit" value="Delete">
								</td>
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
//DELETE RESERVATION
if(isset($_POST['deleteReservation'])){
		$resID2 = strip_tags($_POST['resID2']);
		
		
		$sql = "DELETE FROM reserves WHERE resID='$resID2'";
		
		$sql5 = "UPDATE books SET numberofcopies = (numberofcopies +1) WHERE bookID = (SELECT bookID FROM reserves WHERE resID ='$resID2')";
		
		mysqli_query($db, $sql5);
		mysqli_query($db, $sql);
		
		header("Refresh:0");
	}
?>

<?php
//ADD RESERVATION
if(isset($_POST['addReservation'])){
		$bookID_add = strip_tags($_POST['bookID_reg']);
		$userID_add = strip_tags($_POST['userID_reg']);
		$date = date('Y-m-d H:i:s');
		
		
		
		$sql3 = "INSERT into reserves(bookID, userID,reservedate)
		VALUES ('$bookID_add', '$userID_add','$date')";
		
		$sql4 = "UPDATE books SET numberofcopies = (numberofcopies -1) WHERE bookID = '$bookID_add'";
		
		
		
		mysqli_query($db, $sql3);
		mysqli_query($db, $sql4);
		
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





