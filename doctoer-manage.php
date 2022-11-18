<?php include('includes/header.php'); 

$servername = "localhost";
$username="root";
$password="";
$dbname="my_db";

$id="";
$First_name="";
$Last_name="";
$gender = "";
$Address="";
$Mobile="";
$Birthday="";
$NIC="";
$age = "";
$Dtype = "";
$Username="";
$Password="";
$role="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//connect to mysql database
    try{
         $conn =mysqli_connect($servername,$username,$password,$dbname);
    }catch(MySQLi_Sql_Exception $ex){
        echo("error in connecting");
    }
//get data from the form
function getData()
{
    $data = array();
    $data[0]=$_POST['id'];
    $data[1]=$_POST['First_name'];
    $data[2]=$_POST['Last_name'];
    $data[3]=$_POST['gender'];
    $data[4]=$_POST['Address'];
    $data[5]=$_POST['Mobile'];
    $data[6]=$_POST['Birthday'];
    $data[7]=$_POST['NIC'];
    $data[8]=$_POST['Age'];
    $data[9]=$_POST['Dtype'];
    $data[10]=$_POST['Username'];
    $data[11]=$_POST['Password'];
    $data[12]=$_POST['role'];

    return $data;
}

//insert (insert data into table doctor)
if(isset($_POST['insert'])){
    if(!empty ($_POST['First_name']) && !empty ($_POST['Last_name']) && !empty ($_POST['gender']) &&
	!empty ($_POST['Address']) && !empty ($_POST['Mobile']) && !empty ($_POST['Birthday']) &&
	 !empty ($_POST['NIC']) && !empty ($_POST['Age']) && !empty ($_POST['Dtype']) && !empty ($_POST['Username']) &&
	  !empty ($_POST['Password'])){

        $info = getData();
        $insert_query="INSERT INTO `doctor`(`First_name`, `Last_name`, `gender`, `Address`, `Mobile`, `Birthday`, `NIC`, `Age`, `Dtype`, `Username`, `Password`) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]', '$info[5]','$info[6]','$info[7]','$info[8]', '$info[9]','$info[10]','$info[11]')";
    
    
    }
    
    try{
        if(!empty ($_POST['First_name']) && !empty ($_POST['Last_name']) && !empty ($_POST['gender']) &&
	!empty ($_POST['Address']) && !empty ($_POST['Mobile']) && !empty ($_POST['Birthday']) &&
	 !empty ($_POST['NIC']) && !empty ($_POST['Age']) && !empty ($_POST['Dtype']) && !empty ($_POST['Username']) &&
	  !empty ($_POST['Password'])){
            $insert_result=mysqli_query($conn, $insert_query);

                ?>
                    <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">
                        data inserted successfully
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                <?php
      }else{
        ?>
            <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                data are not inserted
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        <?php
      }
    
    }catch(Exception $ex){
        ?>
            <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                data are not inserted
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        <?php
    }
    }

//insert2 (insert data into table users)
if(isset($_POST['insert'])){
        if(!empty ($_POST['role'])){
            $info = getData();
            $insert_query="INSERT INTO `users`(`role`, `Username`, `Password`, `name`) VALUES ('$info[12]','$info[10]', '$info[11]','$info[1]')";
    
        }
    try{
        if(!empty ($_POST['role'])){
            $insert_result=mysqli_query($conn, $insert_query);
            }
    }catch(Exception $ex){
    echo("error inserted".$ex->getMessage());
    }
    }

//search
if(isset($_POST['search']))
{
    $info = getData();
    $search_query="SELECT * FROM doctor WHERE id = '$info[0]'";
    $search_result=mysqli_query($conn, $search_query);

    if($search_result)
    {
        if(mysqli_num_rows($search_result))
        {
            while($rows = mysqli_fetch_array($search_result))
            {
                $id = $rows['id'];
                $First_name = $rows['First_name'];
                $Last_name = $rows['Last_name'];
                $gender = $rows['gender'];
                $Address = $rows['Address'];
                $Mobile = $rows['Mobile'];
                $Birthday = $rows['Birthday'];
                $NIC = $rows['NIC'];
                $Age = $rows['Age'];
                $Dtype = $rows['Dtype'];
                $Username = $rows['Username'];
                $Password = $rows['Password'];

            }
        }else{
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                No data are available
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
            <?php
        }
        } else{
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                Result error
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
            <?php
        }

}

//delete
if(isset($_POST['delete'])){
    $info = getData();
    $delete_query = "DELETE FROM `doctor` WHERE id = '$info[0]'";

    try{
        $delete_result = mysqli_query($conn, $delete_query);

        if($delete_result){
            if(mysqli_affected_rows($conn)>0)
            {
                ?>
                    <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">
                        Data deleted
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                <?php
            }else{
                ?>
            <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                    Data not deleted
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
            <?php
            }
        }
    }catch(Exception $ex){
        echo("error in delete".$ex->getMessage());
    }   
}

//update
if(isset($_POST['update'])){
    $info = getData();
    $update_query="UPDATE `doctor` SET `First_name`='$info[1]',Last_name='$info[2]',gender='$info[3]', Address='$info[4]', Mobile='$info[5]', Birthday='$info[6]', NIC='$info[7]', Age='$info[8]', Dtype='$info[9]', Username='$info[10]', Password='$info[11]' WHERE id = '$info[0]'";

try{
    $update_result=mysqli_query($conn, $update_query);

    if($update_result){
        if(mysqli_affected_rows($conn)>0){
            ?>
                <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">
                    Data updated
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
            <?php
        }else{
            ?>
        <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                Data not updated
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        <?php
        }
    }

    }catch(Exception $ex){
        echo("error in update".$ex->getMessage());
    }
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/admin-docter-manage.css">
<main>
        <article>
        
            
            
            <div class=" text-center ">
                <form action="doctoer-manage.php" method="post">
                <div class="form -row py-3 pt-5">
                        <div class="offset-1 col-lg-10">
                            <input type="text"  value="<?php echo($id);?>"  for="id" class="inp px-3" placeholder="ID" name="id" id="id">
                            
                        </div>
                    </div>
                    <div class="form-group py-3">
                        <div class="offset-1 col-lg-10">
                            <select class="inp px-3" for="role" name="role"  name="role" id="role" aria-label="Default select example">
			  		                <option value="doctor">doctor</option>
		                    </select>
                        </div>
                    </div>
                    <div class="form-group py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="text" value="<?php echo($First_name);?>" for="First_name" class="inp px-3" placeholder="First name" name="First_name" id="First_name">
                        </div>
                    </div>
                    <div class="form -row">
                        <div class="offset-1 col-lg-10">
                            <input type="text" value="<?php echo($Last_name);?>" for="Last_name" class="inp px-3" placeholder="Last name" name="Last_name" id="Last_name">
                        </div>
                    </div>

                <div class="form-group py-3">
                    <label for="gender" ><b>Gender</b></label>
                    <div>
                            <label for="male" class="radio-inline">
                                <input type="radio" name="gender" checked value="m" id="male" 
                                    <?php if($gender=="m"){
                                        echo "checked";
                                    }?>
                                />Male &nbsp; &nbsp;
                            <label for="female" class="radio-inline">
                                <input type="radio" name="gender"  value="f" id="female"
                                <?php if($gender=="f"){
                                        echo "checked";
                                    }?>/>Female
                        </div>
                </div>

                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="text" value="<?php echo($Address);?>" for="Address" class="inp px-3" placeholder="Address" name="Address" id="Address">
                        </div>
                    </div>
                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="number" value="<?php echo($Mobile);?>" for="Mobile" class="inp px-3" placeholder="Mobile" name="Mobile" id="Mobile">
                        </div>
                    </div>
                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="date" value="<?php echo($Birthday);?>" for="Birthday" class="inp px-3" placeholder="Birthday" name="Birthday" id="Birthday">
                        </div>
                    </div>
                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="text" value="<?php echo($NIC);?>" for="NIC" class="inp px-3" placeholder="NIC" name="NIC" id="NIC">
                        </div>
                    </div>
                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="number" value="<?php echo($Age);?>" for="Age" class="inp px-3" placeholder="Age" name="Age" id="Age">
                        </div>
                    </div>
                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="text" value="<?php echo($Dtype);?>" for="Dtype" class="inp px-3" placeholder="Speciality" name="Dtype" id="Dtype">
                        </div>
                    </div>
                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="text" value="<?php echo($Username);?>" for="Username" class="inp px-3" placeholder="Username" name="Username" id="Username">
                        </div>
                    </div>
                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="password" value="<?php echo($Password);?>" for="Password" class="inp px-3" placeholder="Password" name="Password" id="Password">
                        </div>
                    </div>

                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <a href=""><button type="submit" name="insert" class="btn1">Save</button></a>
                        </div>
                        <div class="offset-1 col-lg-10">
                            <a href=""><button type="submit" name="search" class="btn1">Search</button></a>
                        </div>
                        <div class="offset-1 col-lg-10">
                            <a href=""><button type="submit" name="delete" class="btn1">Delete</button></a>
                        </div>
                        <div class="offset-1 col-lg-10">
                        <a href=""><button type="submit" name="update" class="btn1">Update</button></a>
                        </div>
                        <div class="offset-1 col-lg-10">
                            <a href=""><button type="submit" name="" class="btn1">Clear</button></a>
                        </div>
                    </div>
                </form>
       
        </article>
    </main>
    <?php include('includes/footer.php'); ?>