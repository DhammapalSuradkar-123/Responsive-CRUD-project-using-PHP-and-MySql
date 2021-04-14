<?php include 'header_nav.php' ?>
<div class="container" id="read">
  <div class="row">
    <h2>Update Record</h2>
    <form class="upde_form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
      <div class="f1">
        <label for="">ID</label>
        <input type="text" name="id" value="" required>
      </div>
      <input type="submit" name="show" value="Show" class="submit">
    </form>
    <?php
       $conn = mysqli_connect("localhost","root","","new_crud") or die("Connection is not build Successfully");

       if(isset($_POST['show'])){
         $id = mysqli_real_escape_string($conn,$_POST['id']);
         $sql = "SELECT * FROM students_info JOIN courses ON students_info.course = courses.course_id
                 WHERE students_info.id = {$id}";
         $squery = mysqli_query($conn, $sql) or die("Error in Query : select");

         if(mysqli_num_rows($squery) > 0){
           while($row = mysqli_fetch_assoc($squery)){
    ?>
    <form action="update_data.php" method="post" autocomplete="off">
      <div class="f1">
        <label for="">NAME</label>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" required>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
      </div>
      <div class="f1">
        <label for="">ADDRESS</label>
        <input type="text" name="address" value="<?php echo $row['address']; ?>" required>
      </div>
      <div class="f1">
        <label for="">COURSE</label>
        <select name="course" required>
          <option value="" disabled>Choose Your Course</option>
          <?php
             $sql1 = "SELECT * FROM courses";
             $squery1 = mysqli_query($conn, $sql1) or die("Error in Query : select");
             if(mysqli_num_rows($squery1) > 0){
               while($row1 = mysqli_fetch_assoc($squery1)){
                 if($row['course'] == $row1['course_id']){
                   $selected = "selected";
                 }else{
                   $selected = "";
                 }
          ?>
          <option <?php echo $selected ?> value="<?php echo $row1['course_id']; ?>"><?php echo $row1['course_name']; ?></option>
        <?php
              }
            }
        ?>
      </select>
      </div>
      <div class="f1">
        <label for="">NUMBER</label>
        <input type="text" name="number" value="<?php echo $row['s_number']; ?>" required>
      </div>
      <input type="submit" name="save" value="Update" class="submit">
    </form>
    <?php
         }
       }else{
         echo "<h4 style='color:red;text-align:center;'>Sorry, Record Not Found!</h4>";
       }
       }
    ?>
  </div>
</div>
