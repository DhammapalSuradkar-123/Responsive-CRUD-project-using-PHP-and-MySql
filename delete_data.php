<?php
  $conn = mysqli_connect("localhost","root","","new_crud") or die("Connection Fails");
  $id = mysqli_real_escape_string($conn,$_GET['id']);
  $sql = "DELETE FROM students_info WHERE id = '{$id}'";
  $squery = mysqli_query($conn, $sql) or die("Error in Query : delete");
  header("location: http://localhost:8012/new_crud/read.php");
?>
