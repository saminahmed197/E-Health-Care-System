<?php include 'header.php';?>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'common_without_login.php';?>

<div class="form-style-5">
<form action="CreatePatientAccount.php" method="post">
<fieldset>
<legend><span class="number">&nbsp;</span>Patient Information:</legend>
<input type="text" name="fname" placeholder="Your First Name *" required />
<input type="text" name="lname" placeholder="Your Last Name *" required />
<input type="email" name="email" placeholder="Your Email * " required />
<label type="text" >Date of Birth:</label>
<input type="date" name="date"   class="form-control" required />
<input type="password" name="password1" placeholder="Create Your Password* " required />
<input type="password" name="password2" placeholder="Type Your Password again* " required />
<input type="text" name="mobile" placeholder="Enter your mobile number* " required />
<input type="text" name="address" placeholder="Enter your Address* " required />

<input type="submit" name= "Register"  value="Register" />
</form>
</div>

<?php

 $conn= mysqli_connect('localhost','root','','find_doctor');



    if(!$conn){
        echo 'Connection Eror '.mysqli_connect_error();
     }
    else{

      
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if ($_POST["password1"]==$_POST["password2"])  {
         $fname =  test_input($_POST["fname"]);
         $lname =  test_input($_POST['lname']);
         $email =  test_input($_POST['email']);
         $password =  test_input($_POST['password1']);
         $password = md5($password);
         $date = test_input($_POST['date']);
         $today = date("Y-m-d");
         $diff = date_diff(date_create($date), date_create($today));
         $age =   $diff->format('%y');
         $mobile = test_input($_POST['mobile']);
         $address = test_input($_POST['address']);


         $sql2 = "SELECT patient_id FROM patient WHERE Email ='$email'";
         $result1=mysqli_query($conn,$sql2);

         if (mysqli_num_rows($result1) == 0) {

         $sql =  "INSERT INTO patient(Patient_id,pass,FirstName,LastName,Email,Date_Of_Birth,age,mobile,address) VALUES('NULL','$password','$fname','$lname','$email','$date','$age','$mobile','$address')";
  
         $result = mysqli_query($conn, $sql);
         $sql3 = "SELECT patient_id FROM patient WHERE Email = '$email'";
         $result2=mysqli_query($conn,$sql3);
        
         if (mysqli_num_rows($result2) == 1) {
           session_start();
           while($row = mysqli_fetch_assoc($result2)){
            $_SESSION['p_id']= $row['patient_id'];
            $_SESSION['FirstName']= $row['FirstName'];
            $_SESSION['LastName']= $row['LastName'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['age']= $row['age'];
            $_SESSION['mobile']= $row['mobile'];
            $_SESSION['address']= $row['address'];
           }
         } 
         
         

         if($result)
         {
         session_start();
         echo " <br/ >Post has been saved successfully";
         $_SESSION['username']= $p_id;
         header("location:welcome-patient.php");
         exit();
         ?>
         <a href="http://localhost/doctor/home.php">Visit Our Home Page</a>
            
        <?php 
 
         }
         else
         {
         echo "Unable to save post";
         }
    
         
         $conn->close(); 


      }else{
                echo "Email already used.";       

      }
       }
       else {
             echo "Password Don't match! try again";
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