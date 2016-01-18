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

  <!-- code for navigation bar -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">studenInfo</a>
      </div>
      <ul class="nav navbar-nav">
        <li ><a href="index.php">Home</a></li>
        <li class="active"><a href="#">ADD NEW Student</a></li>
      </ul>
    </div>
  </nav>

<!-- navigatioin bar code ends -->

<?php require('dbconfig.php');
    // define variables and set to empty values

    $nameErr = $regErr = $cgpaErr =  "";
    $name = $reg = $cgpa =  "";
    $flag =2;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (empty($_POST["name"])) {
         $nameErr = "Name is required";
         $flag = 1;
       } else {
         $name = test_input($_POST["name"]);
         // check if name only contains letters and whitespace
         if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
           $nameErr = "Only letters and white space allowed";
           $flag =1;
         }
       }

       if (empty($_POST["reg"])) {
         $regErr = "Registration Number is required";
         $flag = 1;
       } else {
         $reg = test_input($_POST["reg"]);
         // check if registration number is well-formed

         if (!is_numeric($reg)) {
           $regErr = "Only integer number allowed";
           $flag = 1;
         } else if (strlen($reg) != 10 ) {
           $regErr = "10 digits only";
           $flag = 1;
         }
         // check if req no exists
         $sql1 = "SELECT * FROM studentinfo where registration_no='$reg'";
         if ($conn->query($sql1) === TRUE) {
           if ($result->num_rows > 0) {
             $regErr = "Registration number exists";
             $flag = 1;
           }
         }
         // exist check code ends here

       }

       if (empty($_POST["cgpa"])) {
         $cgpaErr = "OK. OK, Don't be so shy. Tell us about CGPA";
         $flag = 1;
      }  else {
         $cgpa = test_input($_POST["cgpa"]);
         // check  if cgpa is in proper format
         if(!is_numeric($cgpa)) {
           $cgpaErr = "CGPA must be value";
           $flag = 1;
         } else {
           $cgpa = floatval($cgpa);
           $cgpa = round($cgpa, 2);
            if(($cgpa > 4) || ( $cgpa < 0)) {
            $cgpaErr = "CGPA cannot be more than 4.00 or less than 0.00";
            $flag = 1;
          }
         }
       }
       //--  PHP validation code ends here

      // Insert data to database if there is no error
       if ($flag != 1) {

         $sql2 = "INSERT INTO studentinfo (name, registration_no, cgpa)
         VALUES ('$name', '$reg', '$cgpa')";

         if ($conn->query($sql2) === TRUE) {
               // echo "Data added Succesfully";
               header('Location: index.php');
             }  else {
                   //echo "Error: " . $sql . "<br>" . $conn->error;
                   $message = "Something went wrong.  sql  error";
                   //header('Location: index.php?meg='.$message);
            }

           $conn->close();
       } else {
        // echo "something went wrong";
       }



    }

    function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }


?>

<!-- html form code goes here -->

		<div class="container">
			<div class="col-md-6 col-md-offset-3">
			  <h2>ADD Student Info</h2>

			  <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			    <div class="form-group">
			      <label for="name">Name</label>
			      <input type="text" name="name" placeholder="Full Name"  class="form-control" >
            <span class="error">* <?php echo $nameErr;?></span>

			    </div>

			    <div class="form-group">
			      <label for="reg">Registration NO</label>
			      <input type="text" name="reg" placeholder="10 Digit Registration Number" class="form-control" required>
            <span class="error">* <?php echo $regErr;?></span>
			    </div>

			    <div class="form-group">
			      <label for="cgpa">CGPA</label>
			      <input type="text" name="cgpa" placeholder="Provide CGPA as '4.00'" class="form-control">
            <span class="error">* <?php echo $cgpaErr;?></span>
			    </div>

			    <button type="submit" class="btn btn-primary pull-right">ADD</button>

			  </form>
			</div>
		</div>

<!-- html form code ends here -->






</body>
</html>
