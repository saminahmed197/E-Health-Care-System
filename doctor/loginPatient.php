<?php include 'header.php';?>
<link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
   <?php include 'common_without_login.php';?>

		<div class="login">
			<h1>Login (Patient)</h1>
			<form action="loginPatient.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Email" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>

      <?php
         
         $conn= mysqli_connect('localhost','root','','find_doctor');

         if(!$conn){
         echo 'Connection Eror '.mysqli_connect_error();
         }else{

         	
         }
         
         if ($_SERVER["REQUEST_METHOD"] == "POST"){
         	$username=test_input($_POST['username']);
         	$password=test_input($_POST['password']);
         	$password=md5($password);

         	$sql ="SELECT * FROM patient WHERE Email='$username' AND pass='$password'";
         	$result=mysqli_query($conn, $sql);

         	
             if (mysqli_num_rows($result) == 1) {
                  session_start();
                  while ($row = mysqli_fetch_assoc($result)) {
                      $_SESSION['p_id']= $row['patient_id'];
                      $_SESSION['FirstName']= $row['FirstName'];
                      $_SESSION['LastName']= $row['LastName'];
                      $_SESSION['Email'] = $row['Email'];
                      $_SESSION['age']= $row['age'];
                      $_SESSION['mobile']= $row['mobile'];
                      $_SESSION['address']= $row['address'];
                  }
               header("location: welcome-patient.php");
            } else {
               header("location: home.php");
            }
           
         	
         }
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

         mysqli_close($conn);
        ?>



          


	</body>
</html>