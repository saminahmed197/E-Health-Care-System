<?php include 'header.php';?>
  <?php 
   session_start();
   if (!isset($_SESSION['p_id'])) {
      header("location:home.php");
      exit();
   }


  ?>
<?php
  
  $conn= mysqli_connect('localhost','root','','find_doctor');
  $chamber_id = $_GET['chamber_id'];
  $Doctorid = $_GET['Doctorid'];
  $patient_id = $_SESSION['p_id'];
?>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include 'top_view_patient.php';?>

<br> <br>    
<div class="form-style-5">
  <form action=<?php echo '"make_appointment.php?chamber_id='.$chamber_id.'&Doctorid='.$Doctorid.'"' ?>  method="post">
    <fieldset>

    <label type="text" >Pick Date:</label>
    <input type="date" name="date"   class="form-control" required />
    <input type="submit" name= "Register"  value="Submit" />
  </form>
</div>



<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $date = test_input($_POST['date']);
    //echo "isset($_GET['a_id'])";
    if (isset($_GET['a_id'])) {
      $a_id = $_GET['a_id'];
      echo $a_id.'<br>';
      echo $chamber_id.'<br>';
      echo $Doctorid.'<br>';

      $sql =  "UPDATE appointment SET date_ = '$date' WHERE Appointment_id='$a_id'";
      $result = mysqli_query($conn,$sql);
      if ($result) {
        header("location: welcome-patient.php");
      } else {
        echo 'Something went wrong.';
      }

    } else {
      $sql =  "INSERT INTO appointment(Appointment_id, date_, Patient_id, Doctorid, Chamber_id) VALUES('NULL', '$date', '$patient_id', '$Doctorid', '$chamber_id')";
      $result = mysqli_query($conn,$sql);
      if ($result) {
        header("location: welcome-patient.php");
      } else {
        echo 'Something went wrong.';
      }
    }
    

  }


  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
</body>
</html>