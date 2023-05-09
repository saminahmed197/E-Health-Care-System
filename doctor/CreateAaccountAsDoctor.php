<?php include 'header.php';?>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php include 'common_without_login.php';?>
<div class="form-style-5">
  <form action="CreateAaccountAsDoctor.php" method="post">
    <fieldset>
      <legend> <h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Doctor Information</h2></legend>
      <input type="text" name="fname" placeholder="Your First Name *" required />
      <input type="text" name="lname" placeholder="Your Last Name *" required />
      <input type="email" name="email" placeholder="Your Email * " required />
      <input type="password" name="password1" placeholder="Create Your Password* " required />
      <input type="password" name="password2" placeholder="Confirmed Password* " required />
      <input type="text" name="Designation" placeholder="Your Designation *" required />
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
       $Designation =  test_input($_POST['Designation']);
       $password = md5($password);
       
       $sql2 = "SELECT Doctorid FROM doctor WHERE Email = '$email'";
       $result1=mysqli_query($conn,$sql2);

       if (mysqli_num_rows($result1) == 0) {

         $sql =  "INSERT INTO doctor(Doctorid,FirstName,LastName,Email,Pass,Designation) VALUES('NULL','$fname','$lname','$email','$password','$Designation')";

         $result = mysqli_query($conn, $sql);
         
         $sql3 = "SELECT Doctorid FROM doctor WHERE Email = '$email'";
         $result2=mysqli_query($conn,$sql3);
        
         if (mysqli_num_rows($result2) == 1) {
           session_start();
           while($row = mysqli_fetch_assoc($result2)){
              $last_id = $row["Doctorid"];
              $_SESSION['Email']= $username;
              $_SESSION['d_id']= $row['Doctorid'];
              $_SESSION['FirstName']= $row['FirstName'];
              $_SESSION['LastName']= $row['LastName'];
              $_SESSION['Designation']= $row['Designation'];
           }
         } 


         if($result) {
           // echo " <br/ >Post has been saved successfully";
           header("location:welcome.php");
           exit();
         }
         else
         {
         echo "Unable to save post";
         }
    
         $conn->close(); 
       } else{
            echo "Account Already Created Using thats mail.";
        }  

    }
     else {
           echo "Password Don't match! try again.";
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