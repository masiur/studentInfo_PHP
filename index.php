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
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">  
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    
</head>
<body>

<?php
$sql = "SELECT *FROM studentinfo";
$result = $conn->query($sql);

?>

<!-- code for navigation bar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">studenInfo</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li ><a href="add.php">ADD NEW Student</a></li>
    </ul>
  </div>
</nav>

<!-- navigatioin bar code ends -->
  <div class="container">
    <h2>Student Info Display</h2>
    <p>Every Students from database are displyed here.</p>
<!-- right side add buttton commented     <a href="add.php"><button type="submit" class="btn btn-success pull-right">Add New</button></a>
-->
    <table class="table table-striped table-hover table-bordered" id="dataTable">
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


                echo  '<tr>
                      <td>'.$row["name"].'</td>
                      <td>'.$row["registration_no"] .'</td>
                      <td>'.$row["cgpa"] .'</td>
                      <td><a href="edit.php?id='.$row['id'].'"><button type="button" class="btn btn-primary btn-xs">Edit</button></a></td>
                      <td><a href="delete.php?id='.$row['id'].'"><button type="button" class="btn btn-danger btn-xs">Delete</button></a></td>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#dataTable').DataTable();
  });
</script>

</body>
</html>
