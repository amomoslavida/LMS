<?php
	session_start();
	if( $_SESSION["user"] == true ){
		
	if($_SESSION['id'] == 1){
		header("Location: books.php");
			return;
			} 
				$id=$_SESSION['id'];
	
	
	
	
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
  
 <li><a style="color:white;cursor:pointer;"  onclick="window.location.href='reservations2.php';">My Reservations</a></li>
  <li><a style="color:white;cursor:pointer;"  class="active" onclick="window.location.href='books2.php';">Books</a></li>
  <li><a style="color:white;cursor:pointer;"   onclick="window.location.href='profile.php';">My Profile</a></li>
  <li><a style="color:white;cursor:pointer;"  onclick="window.location.href='logout.php'">Log Out</a></li>
 
</ul>

 <div class="middle">
  <h2>Books</h2>
  
  <table class="cinereousTable">
	<thead>
		<tr>
			<th> bookID </th>
			<th> name </th>
			<th> author </th>
			<th> genre </th>
			<th> decription </th>
			<th> copies </th>
		</tr>
	</thead>
	<tbody>
<?php
	$sql = "SELECT bookID, name, author, genre, description, numberofcopies
			FROM books
			ORDER BY bookID ASC
			";

	
	$res = mysqli_query($db, $sql) or die(mysqli_error($db));
	
	$post = "";
	
	if(mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_assoc($res)){
			$bookID = $row['bookID'];
			$name = $row['name'];
			$author = $row['author'];
			$genre = $row['genre'];
			$description = $row['description'];
			$copies = $row['numberofcopies'];
			
			
			
			$post .=  "
							<tr>
								<td> $bookID </td>
								<td> $name </td>
								<td> $author </td>
								<td> $genre </td>
								<td> $description </td>
								<td> $copies </td>
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
				</tr>
		
		";
	}
	
?>



	</tbody>
</table>
<br />
		




</body>
</html>




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