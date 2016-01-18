<?php require('dbconfig.php');
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

<?php
$sql = "SELECT *FROM studentinfo";
$result = $conn->query($sql);

?>

  <div class="container">
    <h2>Student Info Display</h2>
    <p>Every Students from database are displyed here.</p>
    <a href="add.php"><button type="submit" class="btn btn-success pull-right">Add New</button></a>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Registration No</th>
          <th>CGPA</th>
          <th>Action</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

<?php
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {


                echo  '<tr class="success">
                      <td>'.$row["name"].'</td>
                      <td>'.$row["registration_no"] .'</td>
                      <td>'.$row["cgpa"] .'</td>
                      <td><a href="edit.php?id='.$row['id'].'"><button type="button" class="btn btn-primary btn-xs">Edit</button></a></td>
                      <td><a href="delete.php?id='.$row['id'].'"><button type="button" class="btn btn-primary btn-xs">Delete</button></a></td>
                      </tr>';
            }
        } else {
            echo "0 results";
        }
      $conn->close();
?>




      </tbody>
    </table>
  </div>


</body>
</html>
