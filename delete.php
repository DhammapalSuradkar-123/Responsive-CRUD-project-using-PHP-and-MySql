<?php include 'header_nav.php' ?>
<div class="container" id="read">
  <div class="row">
    <h2>Delete Record</h2>
    <?php
       if(isset($_POST['delete'])){
         $conn = mysqli_connect("localhost","root","","new_crud") or die("Connection is not build Successfully");

         $id = mysqli_real_escape_string($conn,$_POST['id']);

         $sql = "SELECT * FROM students_info WHERE id = '{$id}'";
         $squery = mysqli_query($conn, $sql) or die("Error in Query : select");

         if(mysqli_num_rows($squery) > 0){
           $sql1 = "DELETE FROM students_info WHERE id = '{$id}'";
           $squery1 = mysqli_query($conn, $sql1) or die("Error in Query : delete");

           header("location: http://localhost:8012/new_crud/read.php");
         }else{
           echo "<h4 style='color:red;text-align:center;'>Sorry, Record Not Found!</h4>";
         }
       }
    ?>
    <form class="upde_form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
      <div class="f1">
        <label for="">ID</label>
        <input type="text" name="id">
      </div>
      <input type="submit" name="delete" value="Delete" class="submit">
    </form>
  </div>
</div>
