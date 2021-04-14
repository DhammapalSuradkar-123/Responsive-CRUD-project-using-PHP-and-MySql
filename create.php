<?php include 'header_nav.php' ?>
<div class="container" id="read">
  <div class="row">
    <div class="col">
    <h2>Add Data</h2>
    <?php
       $conn = mysqli_connect("localhost","root","","new_crud") or die("Connection is Not Build Successfully");
       $sql = "SELECT * FROM courses";
       $squery = mysqli_query($conn, $sql) or die("Error in Query : select");

       if(isset($_POST['save'])){
         $name = mysqli_real_escape_string($conn,$_POST['name']);
         $address = mysqli_real_escape_string($conn,$_POST['address']);
         $course = mysqli_real_escape_string($conn,$_POST['course']);
         $number = mysqli_real_escape_string($conn,$_POST['number']);

         $sql1 = "INSERT INTO students_info(name,address,course,s_number)
                  VALUES ('{$name}','{$address}','{$course}','{$number}')";
         $squery1 = mysqli_query($conn, $sql1) or die("Error in Query : insert");

         header("location: http://localhost:8012/new_crud/read.php");
       }

       if(mysqli_num_rows($squery) > 0){
    ?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
      <div class="f1">
        <label for="name">NAME</label>
        <input type="text" name="name" required>
      </div>
      <div class="f1">
        <label for="address">ADDRESS</label>
        <input type="text" name="address" required>
      </div>
      <div class="f1">
        <label for="course">COURSE</label>
        <select name="course" required>
          <option value="" selected disabled>Choose Your Course</option>
          <?php
             while($row = mysqli_fetch_assoc($squery)){
          ?>
          <option value="<?php echo $row['course_id']; ?>"><?php echo $row['course_name']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="f1">
        <label for="number">NUMBER</label>
        <input type="text" name="number" required>
      </div>
      <input type="submit" name="save" value="Save" class="submit">
    </form>
    <?php } ?>
  </div>
</div>
</div>
