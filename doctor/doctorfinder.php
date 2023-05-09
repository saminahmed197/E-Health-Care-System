<?php include 'header.php';?>
	<link rel="stylesheet" type="text/css" href="style2.css">
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

  <div style="width:500px;  margin: auto; padding:1em;">
  <div class="form-style-2">
  <div class="form-style-2-heading">Search  a Doctor:</div>
   <form action="doctorfinder.php" method="post">
     <label for="field1"><span>Area: <span class="required">*</span></span><input type="text" class="input-field" name="area" value="" /></label>
     

     <label for="field4"><span>Specilization:</span><select name="Specialization" class="select-field">
           <option value="Allergists">Allergists</option>
           <option value="Anesthesiologists">Anesthesiologists</option>
           <option value="Sports Medicine Specialists">Sports Medicine Specialists</option>
           <option value="Dermatologists">Dermatologists</option>
           <option value="Endocrinologists">Endocrinologists</option>
           <option value="Emergency Medicine Specialists">Emergency Medicine Specialists</option>
           <option value="Gastroenterologists">Gastroenterologists</option>
           <option value="Hematologists">Hematologists</option>
           <option value="Infectious Disease Specialists">Infectious Disease Specialists</option>
           <option value="Internists">Internists</option>
           <option value="Medical Geneticists">Medical Geneticists</option>
           <option value="Neurologists">Neurologists</option>
           <option value="Neurologists">Neurologists</option>
           <option value="Obstetricians and Gynecologists">Obstetricians and Gynecologists</option>
           <option value="Pathologists">Pathologists</option>
           <option value="Pediatricians">Pediatricians</option>
           <option value="Plastic Surgeons">Plastic Surgeons</option>
           <option value="Psychiatrists">Psychiatrists</option>
           <option value="Urologists">Urologists</option>
      </select></label>
      <br> <br> 
     <label><span> </span><input type="submit" value="Submit" name="submit" /></label>
      </form>
   </div>

</div>


<table>
<?php 
  $myid=$_SESSION['p_id'];
  $flag=0;
  $conn= mysqli_connect('localhost','root','','find_doctor');
  $sql1="SELECT S_Name FROM specilization WHERE DoctorId ='$myid'";
  $result1 = mysqli_query($conn, $sql1);
  if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $spec =  $_POST["Specialization"];
    $area =  strtoupper (test_input($_POST['area']));

    $sql = "SELECT * FROM chamber C 
              INNER JOIN doctor D on C.Doctorid=D.Doctorid 
              WHERE UPPER(address) ='$area'";
    $result = mysqli_query($conn, $sql);

    echo '<br><br>';
    while ($row = mysqli_fetch_assoc($result)) {
      $chamber_id = $row['Chamber_id'];
      $Doctorid = $row['Doctorid'];
      $url = 'http://localhost/doctor/make_appointment.php?chamber_id='.$chamber_id.'&Doctorid='.$Doctorid;
      echo '<tr><th><br>';
      echo 'Doctor: '.$row['FirstName'].' '.$row['LastName'].'<br>';
      echo 'Designation: '.$row['Designation'].'<br>';
      echo 'Chamber Details: '.$row['Chamberinfo'].', '.$row['Address'].'<br>';
      echo 'Contact: '.$row['Contact'].' <a href="'.$url.'"> <br> Create Appointment</a>';
      echo '<br><br>';
      echo '</tr></th>';
    }
  }

  
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
?>
</table>
</body>
</html>