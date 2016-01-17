<?php require('dbconfig.php');
$id = $_GET["id"];
echo $id;

$sql = "SELECT * FROM studentinfo where id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $name = $row["name"];
      $reg = $row["registration_no"];
      $cgpa = $row["cgpa"];
      echo $name;
    }
  } else {
    echo "0 results";
  }
?>


              <div class="container">
          			<div class="col-md-4 col-md-offset-4">
          			  <h2>Edit Student Info</h2>

          			  <form role="form" action="add_data.php" method="POST">
          			    <div class="form-group">
          			      <label for="name">Name</label>
          			      <input type="text" name="name" value=<?php echo $name; ?> class="form-control" required>

          			    </div>

          			    <div class="form-group">
          			      <label for="reg">Reg NO</label>
          			      <input type="text" name="reg" value=<?php echo $reg; ?> class="form-control" required>
          			    </div>

          			    <div class="form-group">
          			      <label for="cgpa">CGPA</label>
          			      <input type="text" name="cgpa" value=<?php echo $cgpa; ?> class="form-control">
          			    </div>

          			    <button type="submit" class="btn btn-primary pull-right">Update</button>

          			  </form>
          			</div>
          		</div>
