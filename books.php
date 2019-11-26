<?php
	session_start();
		
	if( $_SESSION["user"] == true ){
		
	if($_SESSION['id'] != 1){
			header("Location: books2.php");
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
  <li><a style="color:white;cursor:pointer;"  onclick="window.location.href='home.php'">Users</a></li>
  <li><a style="color:white;cursor:pointer;"  class="active" onclick="window.location.href='books.php';">Books</a></li>
  <li><a  style="color:white;cursor:pointer;"  onclick="window.location.href='reservations.php';">Reservation</a></li>
  <li><a style="color:white;cursor:pointer;" onclick="window.location.href='logout.php'">Log Out</a></li>
 
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
		<div id="mod-user">
		
		
		
			<button class="collapsible">Register Book</button>
			<div class="content" style="text-align:left;">
				<form action="books.php" method="post">
					<table class="cinereousTable">
						<tr>
							<td>Name</td>
							<td><input name="name_reg" type="text" cols="50"></td>
						</tr>
						<tr>
							<td>Author</td>
							<td><input  name="author_reg" type="text" cols="50">
						</tr>
						<tr>	
							<td>Genre</td>
							<td><input name="genre_reg" type="text" cols="50"></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><input name="description_reg" type="text" cols="50" rows="5"></td>
						</tr>
						<tr>
							<td>copies</td>
							<td><input placeholder="number of copies to register" name="copies_reg" type="text" cols="50"></td>
						</tr>		
					</table>
					<div  style="padding-top:5px;padding-bottom:5px;">
						<input name="registerBook" type="submit" value="Register" style="padding:4px;padding-left:6px;padding-right:6px;">
					</div>
				</form>
			</div>
			
			
			<button class="collapsible">Add Book</button>
			<div class="content">
				<form action="books.php" method="post">
					<div  style="padding-top:5px;padding-bottom:5px;">
						<table style="width:100%;">
							<tr>
								<td>
								Book: 
								</td>
								
								<td>
								<select name="bookID4" style="width:72%">
							<?php
							
							$sql_del = "SELECT bookID, name FROM books ORDER BY bookID ASC";
	
							$res = mysqli_query($db, $sql_del) or die(mysqli_error($db));
							
							$options4 = "";
							while($row = mysqli_fetch_assoc($res)){
								$bookID4 = $row['bookID'];
								$name4 = $row['name'];
			
			
								$options4 .=  "
											
												<option value='$bookID4'>ID: $bookID4, $name4</option>
											
										";
							}
							echo $options4;
							
								?>
								</select>
								
								</td>
							</tr>
							<tr>
								<td>
									Number:
								</td>
								<td>
									<input placeholder="number of copies to add" name="copies_add" type="text" cols="50">
									<input name="addBook" type="submit" value="Add">
								</td>
							
					</table>
					</div>
				</form>
			</div>
			
			
			
			
			
		
			<button class="collapsible">Delete Book</button>
			<div class="content">
				<form action="books.php" method="post">
					<div  style="padding-top:5px;padding-bottom:5px;">
						<table style="width:100%;">
							<tr>
								<td>
								Book: 
								</td>
								
								<td>
								<select name="bookID2" style="width:72%">
							<?php
							
							$sql_del = "SELECT bookID, name FROM books ORDER BY bookID ASC";
	
							$res = mysqli_query($db, $sql_del) or die(mysqli_error($db));
							
							$options4 = "";
							while($row = mysqli_fetch_assoc($res)){
								$bookID2 = $row['bookID'];
								$name2 = $row['name'];
			
			
								$options4 .=  "
											
												<option value='$bookID2'>ID: $bookID2, $name2</option>
											
										";
							}
							echo $options4;
							
								?>
								</select>
								
								</td>
							</tr>
							<tr>
								<td>
									Number:
								</td>
								<td>
									<input placeholder="number of copies to delete" name="copies_del" type="text" cols="50">
									<input name="deleteBook" type="submit" value="Delete">
								</td>
							
							
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input name="deleteKomple" type="submit" value="Delete Record">
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
//DELETE BOOK
if(isset($_POST['deleteBook'])){
		$bookID2 = strip_tags($_POST['bookID2']);
		$copies_del = strip_tags($_POST['copies_del']);
		
		
		
			$sql_del = "UPDATE books
						SET numberofcopies = (numberofcopies - '$copies_del')
						WHERE bookID = '$bookID2'
						";
			mysqli_query($db, $sql_del);
		
		
		header("Refresh:0");
	}
	
	if(isset($_POST['deleteKomple'])){
		$bookID2 = strip_tags($_POST['bookID2']);
		
			$sql_delkomple = "DELETE FROM books WHERE bookID ='$bookID2'
						";
			mysqli_query($db, $sql_delkomple);
		
		
		header("Refresh:0");
	}
	
?>



<?php
//ADD BOOK
if(isset($_POST['addBook'])){
		$bookID4 = strip_tags($_POST['bookID4']);
		$copies_add = strip_tags($_POST['copies_add']);
		
			$sql_add = "UPDATE books
						SET numberofcopies = (numberofcopies + '$copies_add')
						WHERE bookID = '$bookID4'
						";
			mysqli_query($db, $sql_add);
		
		
		header("Refresh:0");
	}
	
?>







<?php
//ADD USER
if(isset($_POST['registerBook'])){
		$name_add = strip_tags($_POST['name_reg']);
		$author_add = strip_tags($_POST['author_reg']);
		$genre_add = strip_tags($_POST['genre_reg']);
		$description_add = strip_tags($_POST['description_reg']);
		$copies_add = strip_tags($_POST['copies_reg']);
		
		
	
		
		$sql3 = "INSERT into books(name, author, genre, description, numberofcopies)
		VALUES ('$name_add', '$author_add', '$genre_add', '$description_add', '$copies_add')";
		
		if($name_add == "" || $copies_add == "") {
			
			function alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
			alert("Please fill name and numOfCopies");
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