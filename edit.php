<?php
session_start();
require('dbconfig.php');

$dbname = 'studentinfo';
$collection = 'studentinfo_collection';

//DB connection
$db = new DbManager();
$conn = $db->getConnection();

$id = $_GET["id"];
//echo $reg;

$filter = [ "_id" => new MongoDB\BSON\ObjectId($id)];
$option = [];

$read = new MongoDB\Driver\Query($filter, $option);

$students = $conn->executeQuery("$dbname.$collection", $read);
//print_r($students[0]);
//$name = null;
//$reg = null;
//$cgpa = null;
foreach ($students as $student) {
//    print_r($student);
    $name = $student->name;
    $reg = $student->reg;
    $cgpa = $student->cgpa;

}

//$sql = "SELECT * FROM studentinfo where id='$id'";
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//      $name = $row["name"];
//      $reg = $row["registration_no"];
//      $cgpa = $row["cgpa"];
//
//    }
//  } else {
//    echo "0 results";
//  }
//  $conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update || Simple CRUD with PHP</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="author" content="Maisur Rahman Siddiki">
  	<meta name"description" content="Simple CRUD with PHP">
  	<meta name="keywords" content="HTML, CSS, Bootstrap, JSP, Masiur , Basic CRUD">
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<script src="js/bootstrap.min.js"></script>
</head>
<body>
  <!-- code for navigation bar -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">studenInfo</a>
      </div>
      <ul class="nav navbar-nav">
        <li ><a href="index.php">Home</a></li>
        <li ><a href="create.php">ADD NEW Student</a></li>
      </ul>
    </div>
  </nav>

  <!-- navigatioin bar code ends -->

              <div class="container">
          			<div class="col-md-6 col-md-offset-3">
          			  <h2>Edit Student Info</h2>

          			  <form role="form" action="update.php" method="POST">
          			    <div class="form-group">
          			      <label for="name">Name</label>
                      <input name="id" type="hidden" value="<?php  echo $id; ?>">
          			      <input type="text" name="name" value="<?php  echo $name; ?>" class="form-control" required>
          			    </div>

          			    <div class="form-group">
          			      <label for="reg">Reg NO</label>
          			      <input type="text" name="reg" value="<?php echo $reg; ?>" class="form-control" required>
          			    </div>

          			    <div class="form-group">
          			      <label for="cgpa">CGPA</label>
          			      <input type="text" name="cgpa" value="<?php echo $cgpa; ?>" class="form-control" required>
          			    </div>

          			    <button type="submit" class="btn btn-success pull-right">Update</button>

          			  </form>
          			</div>
          		</div>
</body>
</html>
