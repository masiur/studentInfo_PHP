<?php require('dbconfig.php');
$id = $_GET["id"];
$sql = "DELETE FROM studentinfo where id='$id'";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
    header('Location: index.php');
} else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();
?>
