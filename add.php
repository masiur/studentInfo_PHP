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
    <style>
         .error {color: #FF0000;}
    </style>
</head>
<body>
  <!--div>
		<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">Student Info</a>
		    </div>
		    <ul class="nav navbar-nav">
		      <li><a href="#">Home</a></li>
		      <li class="active"><a href="">ADD</a></li>
		    </ul>
		  </div>
		</nav>
  </div -->

<!-- html form code goes here -->

		<div class="container">
			<div class="col-md-6 col-md-offset-3">
			  <h2>ADD Student Info</h2>

			  <form role="form" action="add_data.php" method="POST">
			    <div class="form-group">
			      <label for="name">Name</label>
			      <input type="text" name="name" placeholder="Full Name"  class="form-control" required>

			    </div>

			    <div class="form-group">
			      <label for="reg">Registration NO</label>
			      <input type="text" name="reg" placeholder="10 Digit Registration Number" class="form-control" required>
			    </div>

			    <div class="form-group">
			      <label for="cgpa">CGPA</label>
			      <input type="text" name="cgpa" placeholder="Provide CGPA as '4.00'" class="form-control">
			    </div>

			    <button type="submit" class="btn btn-primary pull-right">ADD</button>

			  </form>
			</div>
		</div>

<!-- html form code ends here -->

</body>
</html>
