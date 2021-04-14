<?php include 'header_nav.php' ?>
<div class="container" id="read">
  <div class="row">
    <h2>Update Data</h2>
    <?php
       $conn = mysqli_connect("localhost","root","","new_crud") or die("Connection Fails");
       $id = mysqli_real_escape_string($conn,$_GET['id']);
       $sql = "SELECT * FROM students_info WHERE id = '{$id}'";
       $squery = mysqli_query($conn, $sql) or die("Error in Query : select1");

       if(isset($_POST['save'])){

         $id = mysqli_real_escape_string($conn,$_POST['id']);
         $name = mysqli_real_escape_string($conn,$_POST['name']);
         $address = mysqli_real_escape_string($conn,$_POST['address']);
         $course = mysqli_real_escape_string($conn,$_POST['course']);
         $number = mysqli_real_escape_string($conn,$_POST['number']);

         $sql2 = "UPDATE students_info SET name = '{$name}', address = '{$address}', course = '{$course}', s_number = '{$number}'
                  WHERE id = '{$id}'";

         $squery2 = mysqli_query($conn, $sql2) or die("Error in query : update");

         header("location: http://localhost:8012/new_crud/read.php");

       }

       if(mysqli_num_rows($squery) > 0){
         while($row = mysqli_fetch_assoc($squery)){
    ?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
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
          <option value="" selected disabled>Choose Your Course</option>
          <?php
             $sql1 = "SELECT * FROM courses";
             $squery1 = mysqli_query($conn, $sql1) or die("Error in Query : select2");

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
      <input type="submit" name="save" value="Save" class="submit">
    </form>
    <?php
            }
          }
    ?>
  </div>
</div>
