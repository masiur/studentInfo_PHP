<?php require('dbconfig.php');

$message = $_GET["meg"];
echo $message;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add || Simple CRUD with PHP</title>
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
    <h2>Contextual Classes</h2>
    <p>Contextual classes can be used to color table rows or table cells. The classes that can be used are: .active, .success, .info, .warning, and .danger.</p>
    <table class="table">
      <thead>
        <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr class="success">
          <td>John</td>
          <td>Doe</td>
          <td>john@example.com</td>
        </tr>
        <tr class="danger">
          <td>Mary</td>
          <td>Moe</td>
          <td>mary@example.com</td>
        </tr>
        <tr class="info">
          <td>July</td>
          <td>Dooley</td>
          <td>july@example.com</td>
        </tr>
      </tbody>
    </table>
  </div>


</body>
</html>
