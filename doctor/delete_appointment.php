<?php include 'header.php';?>
</head>

<body>
<?php include 'top_view_doctor.php';?>
<?php 
   session_start();
   if (!isset($_SESSION['p_id'])) {
      header("location:home.php");
      exit();
   }


?>

  
  <?php
    $d_id = $_SESSION['p_id'];
    $conn= mysqli_connect('localhost','root','','find_doctor');
    if(!$conn){
      echo 'Connection Eror '.mysqli_connect_error();
    } else {
      if (isset($_GET['a_id'])) {
          $a_id = $_GET['a_id'];
          $sql =  "DELETE FROM appointment WHERE Appointment_id = '$a_id'";
          $result = mysqli_query($conn,$sql);
      }

      header("location: welcome-patient.php");

    }
  ?>
  
</div>
<br>
</div>  
</body>
</html>