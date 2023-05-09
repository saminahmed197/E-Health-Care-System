<?php include 'header.php';?>
</head>

<body>
<?php include 'top_view_doctor.php';?>
<?php 
   session_start();
   if (!isset($_SESSION['d_id'])) {
      header("location:home.php");
      exit();
   }


?>
  <br><br> <br>
  <div 
  style="width:400px;  margin: auto; padding:1em;font-size: 30px;
  border-radius: 25px;
  background: #d9d9d9;
  border: 2px solid #73AD21;
  padding: 15px; 
  width:500px;
  ">
  <div style="text-align: center;"> <h3>Doctor Profile <h3></div> 
  
  <?php
    $d_id = $_SESSION['d_id'];
    echo '<b>Name: </b>'.$_SESSION['FirstName'].' '.$_SESSION['LastName'].'<br>';
    echo '<b>Email: </b>'.$_SESSION['Email'].'<br>'; 
    echo '<b>Designation: </b>'.$_SESSION['Designation'].'<br>';
    $conn= mysqli_connect('localhost','root','','find_doctor');
    if(!$conn){
      echo 'Connection Eror '.mysqli_connect_error();
    } else {
      $sql = "SELECT * FROM specilization WHERE Doctorid ='$d_id'";
      $result=mysqli_query($conn,$sql);
      echo '<b>Specialization: </b>';
      $first = 0;
      while ($row = mysqli_fetch_assoc($result)) {
          if ($first == 0) {
            echo $row['S_Name'];
            $first =1 ;
          } else {
            echo ', '.$row['S_Name'];
          }
          
      }
      echo '<br><br><br>';
    }
  ?>
  
</div>
<br>
</div>  
</body>
</html>