<?php require('dbconfig.php');
$id = $_GET["id"];
$sql = "SELECT * FROM studentinfo where id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $name = $row["name"];
      $reg = $row["registration_no"];
      $cgpa = $row["cgpa"];

    }
  } else {
    echo "0 results";
  }
  $conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home || Simple CRUD with PHP</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="author" content="Maisur Rahman Siddiki">
  	<meta name"description" content="Simple CRUD with PHP">
  	<meta name="keywords" content="HTML, CSS, Bootstrap, JSP, Masiur , Basic CRUD">
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<script src="js/bootstrap.min.js"></script>
</head>
<body>



              <div class="container">
          			<div class="col-md-4 col-md-offset-4">
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
          			      <input type="text" name="cgpa" value="<?php echo $cgpa; ?>" class="form-control">
          			    </div>

          			    <button type="submit" class="btn btn-success pull-right">Update</button>

          			  </form>
          			</div>
          		</div>
</body>
</html>
