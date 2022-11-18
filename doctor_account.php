<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('includes/doctor_header.php');
    include("db_conn.php"); ?>
                   
    </nav>
        <main>
        <table class="table table-hover">
			<thead class="table-dark text-center">
                <th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Address</th>
                <th>Mobile</th>
				<th>Birthday</th>
				<th>NIC</th>
                <th>Age</th>
                <th>Specialization</th>
			</thead>
<?php 
	$query = mysqli_query($conn, "SELECT * FROM doctor");
	if($query){
		if(mysqli_affected_rows($conn)>0){
			while($row = mysqli_fetch_array($query)){

				$id = $row['id'];
				$First_name = $row['First_name'];
				$Last_name = $row['Last_name'];
				$gender = $row['gender'];
				$Address = $row['Address'];
				$Mobile = $row['Mobile'];
				$Birthday = $row['Birthday'];
				$NIC = $row['NIC'];
				$Age = $row['Age'];
				$Dtype = $row['Dtype'];
		 ?>
					<tbody>
						<tr class="text-center">
							<td class="table-dark"><?php echo $id; ?></td>
							<td al><?php echo $First_name; ?></td>
							<td><?php echo $Last_name; ?></td>
							<td><?php echo $gender; ?></td>
							<td><?php echo $Address; ?></td>
							<td><?php echo $Mobile; ?></td>
							<td><?php echo $Birthday; ?></td>
							<td><?php echo $NIC; ?></td>
							<td><?php echo $Age; ?></td>
							<td><?php echo $Dtype; ?></td>
						</tr>
					</tbody><?php
			}
		}else{
			?>
                     <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                    No data available	
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                <?php

		}
	}
	 ?>
		</table>
        </main>
        <?php include('includes/footer.php'); ?>