<?php include 'header.php';?>
</head>

<body>
<?php 
   session_start();
   if (!isset($_SESSION['d_id'])) {
      header("location:home.php");
      exit();
   }


?>

<?php include 'top_view_doctor.php';?>
  <?php
    $p_id = $_GET['p_id'];
  ?>
<?php include 'prescription_history_slides.php'?>

</table>
   


</body>
</html>