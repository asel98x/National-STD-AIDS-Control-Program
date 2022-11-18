<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>check signup</title>
</head>
<body>
<?php
	$role = $_POST['role'];
    $First_name = $_POST['First_name'];
	$Last_name = $_POST['Last_name'];
	$gender = $_POST['gender'];
	$address = $_POST['Address'];
	$Mobile = $_POST['Mobile'];
	$Birthday = $_POST['Birthday'];
    $NIC = $_POST['NIC'];
    $Age = $_POST['Age'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

	// Hashing the password
	$Password = md5($Password);

    // Database connection
	$conn = new mysqli('localhost','root','','my_db');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);

	}elseif(!empty ($_POST['First_name']) && !empty ($_POST['Last_name']) && !empty ($_POST['gender']) &&
	!empty ($_POST['Address']) && !empty ($_POST['Mobile']) && !empty ($_POST['Birthday']) &&
	 !empty ($_POST['NIC']) && !empty ($_POST['Age']) && !empty ($_POST['Username']) &&
	  !empty ($_POST['Password'])){

		if(!empty ($_POST['role'])){
			$stmt = $conn->prepare("insert into users(role, Username, Password, name ) values(?, ?, ?, ?)");
			$stmt->bind_param("ssss",  $role, $Username, $Password,$First_name);
			$execval = $stmt->execute();
			echo $execval;
		}

		$stmt = $conn->prepare("insert into admin(First_name, Last_name, gender, Address, Mobile, Birthday, NIC, Age, Username, Password ) values(?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
		$stmt->bind_param("ssssississ", $First_name, $Last_name, $gender, $address, $Mobile, $Birthday, $NIC, $Age, $Username, $Password);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
		

		
	}
	else {
		echo 'invalid';
	}
?>
</body>
</html>