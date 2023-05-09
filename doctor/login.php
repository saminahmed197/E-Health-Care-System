<?php include 'header.php';?>
<link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
   <?php include 'common_without_login.php';?>

	<div class="login">
		<h1>Login (Doctor)</h1>
		<form action="login.php" method="post">
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
      } else {
         if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $username=test_input($_POST['username']);
            $password=test_input($_POST['password']);
            $password=md5($password);

            $sql ="SELECT * FROM doctor WHERE Email= '$username' and Pass = '$password'";
            $result=mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                  session_start();
                  while($row = mysqli_fetch_assoc($result)) {
                     $_SESSION['Email']= $username;
                     $_SESSION['d_id']= $row['Doctorid'];
                     $_SESSION['FirstName']= $row['FirstName'];
                     $_SESSION['LastName']= $row['LastName'];
                     $_SESSION['Designation']= $row['Designation'];
                  }
                  header("location: welcome.php");
            } else {
                  $pk= "login Fail";
                  header("location: home.php");
               
            } 
            
         
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