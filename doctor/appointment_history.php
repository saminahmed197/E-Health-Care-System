<?php 
include 'header.php';
  $conn= mysqli_connect('localhost','root','','find_doctor');
?>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <?php include 'top_view_patient.php';?>
    <?php 
   session_start();
   if (!isset($_SESSION['p_id'])) {
      header("location:home.php");
      exit();
   }


  ?>
  <br><br>
   <table> 
  <?php 

    $date = date('Y-m-d');
    $p_id = $_SESSION['p_id'];
    $sql ="SELECT A.Appointment_id as appointment_id,
                  A.date_ as date_,
                  A.Doctorid as Doctorid,
                  C.Chamber_id as Chamber_id,
                  C.ChamberInfo as ChamberInfo,
                  C.Address  as ChamberAddress,
                  C.Contact as ChamberContact,
                  D.FirstName as FirstName, 
                  D.LastName as LastName, 
                  D.Designation as Designation
                FROM appointment  A 
                  INNER JOIN chamber C on A.Chamber_id=C.Chamber_id 
                  INNER JOIN doctor D on A.Doctorid= D.Doctorid 
                WHERE A.Patient_id='$p_id' 
                AND A.date_ < '$date'
                ORDER BY A.date_  DESC";
    $result=mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) >= 1) {        
      while ($row = mysqli_fetch_assoc($result)) {
         echo '<tr> <th>';
         echo 'Doctor: '.$row['FirstName'].' '.$row['LastName'].'<br>'; 
         echo 'Designation: '.$row['Designation'].'<br>'; 
         echo 'Chamber Info: '.$row['ChamberInfo'].', '.$row['ChamberAddress'].'<br>'; 
         echo 'Contact: '.$row['ChamberContact'].'<br>'; 
         echo 'Appointment Date: '.$row['date_'].'<br><br>';
         echo '</tr> </th>';
      }          
    }
  ?>
  </table>
</body>
</html>