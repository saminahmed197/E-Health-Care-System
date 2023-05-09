<?php include 'header.php';?>
<?php 
   session_start();
   if (!isset($_SESSION['d_id'])) {
      header("location:home.php");
      exit();
   }


?>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'top_view_doctor.php';?>
  

<br><br>
<div class="form-style-5">
  <form action="Set-chamber.php" method="post">
  <fieldset>
  <legend><span class="number">&nbsp;</span>Chamber Info:</legend>
  <input type="text" name="info" placeholder="Chamber Info:*" required />
  <input type="text" name="address" placeholder="Chamber Address*" required />
  <input type="text" name="number" placeholder="Contact Number*" required />
  <label for="appt">From(time):</label>
  <input type="time" id="appt" name="time1" required>
  <label for="appt">To(time):</label>
  <input type="time" id="appt" name="time2" required>
  <input type="submit" name= "Add-Chamber"  value="Add Chamber" />
 </form>
</div> 


   <?php
        $myid=$_SESSION['d_id'];
        $conn= mysqli_connect('localhost','root','','find_doctor');
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $info=test_input($_POST['info']);
           $address=test_input($_POST['address']);
           $number=test_input($_POST['number']);
           $time1 =test_input($_POST['time1']);
           $time2 =test_input($_POST['time2']);
           $time124 = date("H:i", strtotime("$time1"));
           $time224 = date("H:i", strtotime("$time2"));

           if ( $time124< $time224) {
              $sql5="INSERT INTO chamber(Chamber_id,DoctorId,Chamberinfo,Address,Contact,FROM_TIME,TO_TIME)
                              VALUES('NULL','$myid','$info','$address','$number','$time124','$time224')";
             $result = mysqli_query($conn, $sql5);
             if ($result) {
               header("location: welcome.php");
             } else {
               echo "Something Wrong! Try again....";
             }

           }else {
              echo "Choose Times correcly....";
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