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

     if (!is_int($reg)) {
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
       $cgpaErr = "";
     } else if(($cgpa > 4.00) && ( $cgpa < 0.00)) {
       $cgpaErr = "CGPA cannot be more than 4.00 or less than 0.00";
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
