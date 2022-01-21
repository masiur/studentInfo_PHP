<?php
session_start();
require('dbconfig.php');

$dbname = 'studentinfo';
$collection = 'studentinfo_collection';

//DB connection
$db = new DbManager();
$conn = $db->getConnection();


$deletes = new MongoDB\Driver\BulkWrite();
$deletes->delete(
    ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
    ['limit' => 1]
);

$result = $conn->executeBulkWrite("$dbname.$collection", $deletes);

if($result) {
    echo nl2br("Record deleted successfully \n");
    $_SESSION['success'] = "Record deleted successfully";
    header('Location: index.php');
}

?>
