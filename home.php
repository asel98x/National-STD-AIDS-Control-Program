<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['password'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<?php if ($_SESSION['role'] == 'admin') {?>
      		<!-- For Admin -->
      		<?php  
			  header('Location: admin.php'); ?>
			  
			<!-- Customer -->
      	<?php }elseif ($_SESSION['role'] == 'customer') {?>
			<?php  
			  header('Location: customer_account.php'); ?>
		<?php }
		  else { ?>
      		<!-- FOR DOCTOR -->
      		<?php  
			  header('Location: doctor_account.php'); ?>
      	<?php } ?>
      </div>
</body>
</html>
<?php }else{
	header("Location: login.php");
} ?>
