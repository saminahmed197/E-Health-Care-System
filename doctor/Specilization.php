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
    <form action="Specilization.php" method="post">
    <fieldset>
       <label for="Specialization">Choose a Specialization:</label>
           <select id="Specialization" name="Specialization">
           <option value="Allergists">Allergists</option>
           <option value="Anesthesiologists">Anesthesiologists</option>
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
           
     </select><br><br><br><br><br><br>
    <input type="submit" name= "Set-Specilization"  value="Add Specilization" />
    </form>
    </div>

      


      <?php 
        $myid=$_SESSION['d_id'];
        $flag=0;
        $conn= mysqli_connect('localhost','root','','find_doctor');


        $sql1="SELECT S_Name FROM specilization WHERE Doctorid ='$myid'";
        $result1 = mysqli_query($conn, $sql1);
        
    
        

       
        if ($_SERVER["REQUEST_METHOD"] == "POST"){


          $Specilization=test_input($_POST['Specialization']);

          while($row = mysqli_fetch_assoc($result1)){
           if($row["S_Name"]  == $Specilization){
                echo "This Specialization already Add";
                $flag=1;
                break;

              }
           }

         if($flag == 0){
         $sql =  "INSERT INTO specilization(S_Name,DoctorId) VALUES ('$Specilization','$myid')";
  
           $result = mysqli_query($conn, $sql);
           if ($result) {
              header("location: doctor_profile.php");

           } else {
             echo "Something wrong! Pls try again";
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