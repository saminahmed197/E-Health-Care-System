<?php include 'header.php';?>

<?php 
   session_start();
   if (!isset($_SESSION['d_id'])) {
      header("location:home.php");
      exit();
   }


?>

</head>

<body>
<?php include 'top_view_doctor.php';?>


<br><br><br>
<table>


<?php
  $conn= mysqli_connect('localhost','root','','find_doctor');
  if(!$conn){
    echo 'Connection Eror '.mysqli_connect_error();
  } else {
    $d_id = $_SESSION['d_id'];
    $sql = "SELECT * FROM chamber WHERE Doctorid ='$d_id'";
    $result=mysqli_query($conn,$sql);
    echo '<br><br>';
    $num_rows = mysqli_num_rows($result);
    if ($num_rows ==0)  {
      echo '<tr> <th>';
      echo '<div style="text-align:center;">No Chamber Available</div><br>';
      echo '</tr> </th>';
    } else {
      echo '<tr> <th>';
      echo '<div style="text-align:center;">Chamber Information </div><br>';
      echo '</tr> </th>';
      
      $date = date('Y-m-d');
      $sql2 = "SELECT Chamber_id, COUNT(Patient_id) as C FROM appointment 
      WHERE Doctorid='$d_id'
      AND date_='$date' GROUP BY Chamber_id";
      $result2=mysqli_query($conn,$sql2);
      $mp = array();
      while ($row = mysqli_fetch_assoc($result2)) { 
          $mp[$row['Chamber_id']]= $row['C'];
        
      }


      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr> <th>';
        echo '<b>Chamber Location: </b>'.$row['Chamberinfo'].', '.$row['Address'].'<br>';
        echo '<b>Contact: </b>'.$row['Contact'].'<br>';
        if(!array_key_exists($row['Chamber_id'],  $mp)){
             $mp[$row['Chamber_id']]= 0;
        }
        echo '<b>Number of Patients (Today): </b>'.$mp[$row['Chamber_id']].'<br>';
        $url = 'http://localhost/doctor/see_patients.php?chamber_id='.$row['Chamber_id'];
        echo '<b>Visit Chamber: </b>  <a href="'.$url.'"> Go</a>';
        echo '</tr> </th>';
      }
    }
    
  }
?>  
</table>
   


</body>
</html>