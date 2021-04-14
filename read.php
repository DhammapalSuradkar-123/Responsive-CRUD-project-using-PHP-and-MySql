<?php include 'header_nav.php' ?>
<div class="container" id="read">
  <div class="row">
    <div class="col">
    <h2>User Record</h2>
    <?php
       $conn = mysqli_connect("localhost","root","","new_crud") or die("Connection is not Build Successfully");

       if(isset($_GET['page'])){
         $page_number = mysqli_real_escape_string($conn,$_GET['page']);
       }else{
         $page_number = 1;
       }
       $limit = 4;
       $offset = ($page_number-1)*$limit;

       $sql = "SELECT * FROM students_info JOIN courses ON students_info.course = courses.course_id
               LIMIT {$offset}, {$limit}";
       $squery = mysqli_query($conn, $sql) or die("Error in Query : select1");

       if(mysqli_num_rows($squery) > 0){
    ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>NAME</th>
          <th>ADDRESS</th>
          <th>COURSE</th>
          <th>NUMBER</th>
          <th>U & D</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $series = $offset + 1;
          while($row = mysqli_fetch_assoc($squery)){
        ?>
        <tr>
          <td><?php echo $series; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['address']; ?></td>
          <td><?php echo $row['course_name']; ?></td>
          <td><?php echo $row['s_number']; ?></td>
          <td>
            <a href="edit_data.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
            <a href="delete_data.php?id=<?php echo $row['id']; ?>" class="delete">Delete</a>
          </td>
        </tr>
        <?php
             $series++;
             }
        ?>
      </tbody>
    </table>
  <?php }else{
    echo "<h4 style='color:red;text-align:center;'>Sorry, Record Not Found!</h4>";
    }

    // PAGINATION PART
    $sql1 = "SELECT * FROM students_info";
    $squery1 = mysqli_query($conn, $sql1) or die("Error in Query : select2");
    $total_record = mysqli_num_rows($squery1);
    $total_pages = ceil($total_record/$limit);

   ?>
   <div class="pagination">
     <?php
          if($page_number > 1){
            echo '<a href="read.php?page='.($page_number - 1).'">Prev</a>';
          }
          for($i = 1; $i <= $total_pages; $i++){
            if($page_number == $i){
              $active = "active";
            }else{
              $active = "";
            }
            echo '<a href="read.php?page='.$i.'" class='.$active.'>'.$i.'</a>';
          }
          if($page_number < $total_pages){
            echo '<a href="read.php?page='.($page_number + 1).'">Next</a>';
          }
      ?>
    </div>
   </div>
  </div>
</div>
