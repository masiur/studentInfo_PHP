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

<!--  PHP validation code starts here  -->

<?php
  // define variables and set to empty values

  $nameErr = $regErr = $cgpaErr =  "";
  $name = $reg = $cgpa =  "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (empty($_POST["name"])) {
       $nameErr = "Name is required";
     } else {
       $name = test_input($_POST["name"]);
       // check if name only contains letters and whitespace
       if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
         $nameErr = "Only letters and white space allowed";
       }
     }

     if (empty($_POST["reg"])) {
       $regErr = "Registration Number is required";
     } else {
       $reg = test_input($_POST["reg"]);
       // check if registration number is well-formed

       if (!is_numeric($reg)) {
         $regErr = "Only integer number allowed";
       } else if (strlen($reg) != 10 ) {
         $regErr = "10 digits only";
       }
     }

     if (empty($_POST["cgpa"])) {
       $cgpaErr = "OK. OK, Don't be so shy. Tell us about CGPA";
    }  else {
       $cgpa = test_input($_POST["cgpa"]);
       // check  if cgpa is in proper format
       if(!is_float($cgpa)) {
         $cgpaErr = "CGPA must be value";
       } else {
         $cgpa = round($cgpa, 2);
          if(($cgpa > 4) || ( $cgpa < 0)) {
          $cgpaErr = "CGPA cannot be more than 4.00 or less than 0.00";
        }
       }
     }
  }

  function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }

?>

<!--  PHP validation code ends here  -->



		<div class="container">
			<div class="col-md-4 col-md-offset-4">
			  <h2>ADD Student Info</h2>

			  <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			    <div class="form-group">
			      <label for="name">Name</label>
			      <input type="text" name="name"  class="form-control" required>
            <span class="error">* <?php echo $nameErr;?></span>
			    </div>

			    <div class="form-group">
			      <label for="reg">Reg NO</label>
			      <input type="text" name="reg" class="form-control" required>
            <span class="error">* <?php echo $regErr;?></span>
			    </div>

			    <div class="form-group">
			      <label for="cgpa">CGPA</label>
			      <input type="text" name="cgpa" class="form-control">
            <span class="error">* <?php echo $cgpaErr;?></span>
			    </div>

			    <button type="submit" class="btn btn-primary pull-right">ADD</button>

			  </form>
			</div>
		</div>


  <!--
<?php
    $sql = "INSERT INTO studentinfo (name, registration_no, cgpa)
    VALUES ('$name', '$reg', '$cgpa')";

    if ($conn->query($sql) === TRUE) {
        echo "Your Data has been updated Succesfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>




</body>
</html>
