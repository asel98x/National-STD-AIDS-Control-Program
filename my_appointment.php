
<main>
        <article>
        <?php 
include("db_conn.php");?>
<?php include('includes/customer_header.php'); ?>

<table class="table table-hover">
			<thead class="table-dark text-center">
                <th>Name</th>
				<th>doctor</th>
				<th>Date</th>
                <th>Message</th>
			</thead>
<?php 
	$query = mysqli_query($conn, "SELECT * FROM appointments");
	if($query){
		if(mysqli_affected_rows($conn)>0){
			while($row = mysqli_fetch_array($query)){

				$patient = $row['patient'];
				$doctor = $row['doctor'];
				$date = $row['date'];
				$message = $row['message'];
		 ?>

			<tbody>
				<tr class="text-center">
					<td class="table-dark"><?php echo $patient; ?></td>
					<td al><?php echo $doctor; ?></td>
                    <td al><?php echo $date; ?></td>
					<td><?php echo $message; ?>&nbsp;&nbsp;</td>
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
	}?>
	
			

			
			
			

		</table>
        </article>

		
    </main>
	<?php include('includes/footer.php'); ?>