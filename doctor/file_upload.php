<?php include 'header.php';?>
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
   <br><br>
      <br><br>   <br><br>   
   <div style="width:500px;  margin: auto; padding:1em;font-size: 30px;
  border-radius: 25px;
  background: #d9d9d9;
  border: 2px solid #73AD21;
  padding: 15px; 
  width:600px;
  ">   
	   <form action="file_upload.php" method="post" enctype="multipart/form-data">
		    Select Image File to Upload<br>
		    <input type="file" name="file"> <br><br>
		    <input type="submit" name="submit" value="Upload">
		</form>
	</div>    

    <?php
   
    $conn= mysqli_connect('localhost','root','','find_doctor');
	if(!$conn){
		echo 'Connection Eror '.mysqli_connect_error();
	} else {
	    $p_id = $_SESSION['p_id'];
	    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]) ){
	     	$file= $_FILES['file'];
		    $fileName = $_FILES['file']['name'];
		    $fileTmp = $_FILES['file']['tmp_name'];
		    $fileSize = $_FILES['file']['size'];
		    $filesError = $_FILES['file']['error'];
		    $fileType = $_FILES['file']['type'];
		    
		    $fileExt = explode('.',$_FILES['file']['name']);
		    $fileActualExt = strtolower(end($fileExt));
		    $allowed = array('jpg','jpeg','png');
		    if(in_array($fileActualExt,$allowed)){
		        if($_FILES['file']['error'] ===  0){
		            if($_FILES['file']['size'] < 1000000){   
		            	$milliseconds = round(microtime(true) * 1000);
		                $fileNameNew = "img_".$milliseconds.'.'.$fileActualExt;
		                $directoryName = 'uploads/user_'.$p_id.'/';
		                if(!is_dir($directoryName)){
						    mkdir($directoryName,  0777, true);
						}
						$fileDestination = $directoryName.$fileNameNew;
		                move_uploaded_file($_FILES['file']['tmp_name'],$fileDestination);
		                 $sql =  "INSERT INTO prescription
		                 		(prescription_id,file_patient_id,file_name) 
		                 		VALUES('NULL','$p_id',' $fileDestination')";

		                $result = mysqli_query($conn, $sql);
		                header("Location: prescription_history.php");
		            }else{
		                echo "Your file is too big!";
		            }
		        }else{
		            echo "You have an error uploading your file!";
		        }
		    }else{
		        echo "You cannot upload files of this type!";
		    }
	    }
	    
	}
	?>

   </body>
</html>

