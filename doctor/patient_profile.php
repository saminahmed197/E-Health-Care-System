<?php include 'header.php';?>
</head>

<body>
  
  <?php 
   session_start();
   if (!isset($_SESSION['p_id'])) {
      header("location:home.php");
      exit();
   }


  ?>
  <?php include 'top_view_patient.php';?>
  <br>
  <br>
  <div 
  style="width:400px;  margin: auto; padding:1em;font-size: 30px;
  border-radius: 25px;
  background: #d9d9d9;
  border: 2px solid #73AD21;
  padding: 15px; 
  width:500px;
  ">
  <div style="text-align: center;"> <h3>Patient Information <h3></div> 
  <?php
    $p_id = $_SESSION['p_id'];
    echo 'Name:</b> '.$_SESSION['FirstName'].' '.$_SESSION['LastName'].'<br>';
    echo 'Email: '.$_SESSION['Email'].'<br>'; 
    echo 'Age: '.$_SESSION['age'].'<br>'; 
    echo 'Contact: '.$_SESSION['mobile'].'<br>'; 
    echo 'Address: '.$_SESSION['address'].'<br>'; 
    echo '<br><br>';
  ?>
</div>
</body>
</html>