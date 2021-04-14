<?php
  $conn = mysqli_connect("localhost","root","","new_crud") or die("Connection is not build Successfully");

  $id = mysqli_real_escape_string($conn,$_POST['id']);
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $address = mysqli_real_escape_string($conn,$_POST['address']);
  $course = mysqli_real_escape_string($conn,$_POST['course']);
  $number = mysqli_real_escape_string($conn,$_POST['number']);

  $sql = "UPDATE students_info SET name = '{$name}', address = '{$address}', course = '{$course}', s_number = '{$number}'
          WHERE id = '{$id}'";
  $squery = mysqli_query($conn, $sql) or die("Error in Query : update");

  header("location: http://localhost:8012/new_crud/read.php");

?>
