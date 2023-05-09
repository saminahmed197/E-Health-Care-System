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
  <?php
    $p_id = $_SESSION['p_id'];
  ?>
  <?php include 'prescription_history_slides.php'?>
</body>
</html>