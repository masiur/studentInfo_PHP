<!DOCTYPE html>
<html>
<head>
	<title>Create Data || Simple CRUD with PHP & Mongo</title>
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
        <a class="navbar-brand" href="index.php">studentInfo</a>
      </div>
      <ul class="nav navbar-nav">
        <li ><a href="index.php">Home</a></li>
        <li class="active"><a href="create.php">Create NEW Student</a></li>
      </ul>
    </div>
  </nav>

<!-- navigatioin bar code ends -->

<?php
session_start();
require('dbconfig.php');
    // define variables and set to empty values
$dbname = 'studentinfo';
$collection = 'studentinfo_collection';

//DB connection
$db = new DbManager();
$conn = $db->getConnection();


    $nameErr = $regErr = $cgpaErr =  "";
    $name = $reg = $cgpa =  "";
    $flag =2;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (empty($_POST["name"])) {
         $nameErr = "Name is required";
         $flag = 1; // flag is used to check if error or ok
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
	         } else {
	         // check if reg no exists no exists
/*
 * Database Code here
 */

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

           $student = array(
               'name' => $name,
               'reg' => $reg,
               'cgpa' => $cgpa,
               'tags' => array('developer','admin')
           );

           $single_insert = new MongoDB\Driver\BulkWrite();
           $single_insert->insert($student);

           $conn->executeBulkWrite("$dbname.$collection", $single_insert);
           $_SESSION['success'] = "Student created successfully";

           header("Location: index.php");

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
