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
<br><br><br>
<table>

<?php
  $conn= mysqli_connect('localhost','root','','find_doctor');
  if(!$conn){
    echo 'Connection Eror '.mysqli_connect_error();
  } else {
    $d_id = $_SESSION['d_id'];
  
    if (isset($_GET['chamber_id'])) {
      $date = date('Y-m-d');
      $chamber_id = $_GET['chamber_id'];
      $sql = "SELECT P.patient_id as patient_id, 
                   P.FirstName as FirstName,
                   P.LastName as LastName,
                   P.Age as age,
                   A.date_ as date_, 
                   A.Appointment_id as appointment_id 
                   From appointment A INNER JOIN patient P 
                   WHERE Doctorid ='$d_id'
                   AND A.Chamber_id = '$chamber_id' 
                   AND A.date_ = '$date'
                   ORDER BY A.date_ ASC";

        $sql2 = "SELECT * From chamber WHERE Chamber_id='$chamber_id'";
        $result2=mysqli_query($conn,$sql2);
        while ($row = mysqli_fetch_assoc($result2)) {
          echo '<br><br>';
          echo '<tr> <th>';
          echo '<div style="text-align:center;">Patients at '.$row['Chamberinfo'].', '.$row['Address'].'</div><br>';
          echo '</tr> </th>';
        }
                   
    } else {
      $sql = "SELECT P.patient_id as patient_id, 
                   P.FirstName as FirstName,
                   P.LastName as LastName,
                   P.Age as age,
                   A.date_ as date_, 
                   A.Appointment_id as appointment_id 
                   From appointment A INNER JOIN patient P 
                   ON A.Patient_id = P.patient_id
                   WHERE Doctorid ='$d_id'
      
                   ORDER BY date_ DESC";
      echo '<br><br>';
      echo '<tr> <th>';
      echo '<div style="text-align:center;">Patients at All Chambers</div><br>';
      echo '</tr> </th>';
    }
      
    $result=mysqli_query($conn,$sql);    
    while ($row = mysqli_fetch_assoc($result)) {
       $p_id = $row['patient_id'];
       $url = 'http://localhost/doctor/see_prescription.php?p_id='.$p_id;
       echo '<tr> <th>';
       echo 'Name: '.$row['FirstName'].' '.$row['LastName'].'<br>';
       echo 'Age: '.$row['age'].'<br>';
       echo 'Date: '.$row['date_'].'<br>' ;
       echo 'See Prescriptions: <a href="'.$url.'"> Open</a>';
       echo '<br>';
       echo '</tr> </th>';
    }
  }

  
?>  
   
</table>

</body>
</html>