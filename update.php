<?php
session_start();
require('dbconfig.php');
  // define variables and set to empty values

  $nameErr = $regErr = $cgpaErr =  "";
  $name = $reg = $cgpa = $id =   "";
  $flag = 2;


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"]; // the old data id we are going to update
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

  }

  function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }


//--  PHP validation code ends here


$dbname = 'studentinfo';
$collection = 'studentinfo_collection';

//DB connection
$db = new DbManager();
$conn = $db->getConnection();

// Insert data to database if there is no error
  if ($flag != 1) {
      $updatedStudent = array(
          'name' => $name,
          'reg' => $reg,
          'cgpa' => $cgpa,
          'tags' => array('developer','admin')
      );
      $updating = new MongoDB\Driver\BulkWrite();

      $updating->update(
          ['_id' => new MongoDB\BSON\ObjectId($id)],
          ['$set' => $updatedStudent],
          ['multi' => true, 'upsert' => true]
      );
      $result = $conn->executeBulkWrite("$dbname.$collection", $updating);

      if($result) {
          echo nl2br("Record updated successfully \n");
      }

      $_SESSION['success'] = "Student Updated successfully";
       header('Location: index.php');

  } else {
    echo "Something went wrong";
  }

?>
