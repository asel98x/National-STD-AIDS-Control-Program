<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<main>
        <article>
        <?php 

		if(isset($_POST['search']))
		{
			$valueToSearch = $_POST['valueToSearch'];
			// search in all table columns
			// using concat mysql function
			$query = "SELECT * FROM `service` WHERE CONCAT(`id`, `First_name`, `specialty`) LIKE '%".$valueToSearch."%'";
			$search_result = filterTable($query);
			
		}
		else {
			$query = "SELECT * FROM `service`";
			$search_result = filterTable($query);
		}

		// function to connect and execute the query
		function filterTable($query)
		{
			$connect = mysqli_connect("localhost", "root", "", "my_db");
			$filter_Result = mysqli_query($connect, $query);
			return $filter_Result;
		}

?>

<form action="customer_View_clinic_Details.php" method="post">
			<div class="form-group">
			<div class="input-group">
				<input type="text" name="valueToSearch" required  class="form-control" placeholder="Search data">
            	<button type="submit" name="search" class="btn btn-primary">Search</button>
			</div>
			</div>
<table class="table table-hover">
			<thead class="table-dark text-center">
                <th>ID</th>
				<th>First name</th>
				<th>specialty</th>
			</thead>
<!-- populate table from mysql database -->
<?php while($row = mysqli_fetch_array($search_result)):?>
			<tbody>
				<tr class="text-center">
				<td class="table-dark"><?php echo $row['id'];?></td>
                    <td ><?php echo $row['First_name'];?></td>
                    <td><?php echo $row['specialty'];?></td>
				</tr>
				<?php endwhile;?>
			</tbody>

			<?php 
                
			
	 ?>
		</table>
		</form>
        </article>

		
    </main>
	