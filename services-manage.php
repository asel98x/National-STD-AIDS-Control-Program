<?php include('includes/header.php'); 
    $servername = "localhost";
    $username="root";
    $password="";
    $dbname="my_db";
    
    $id="";
    $First_name="";
    $specialty = "";
    
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
        $data[2]=$_POST['specialty'];
        return $data;
    }
    
    //insert (insert data into table doctor)
    if(isset($_POST['insert'])){
        if(!empty ($_POST['First_name']) && !empty ($_POST['specialty'])){
    
            $info = getData();
            $insert_query="INSERT INTO `service`(`First_name`, `specialty`) VALUES ('$info[1]','$info[2]')";
        
        }
        
        try{
            if(!empty ($_POST['First_name'])  && !empty ($_POST['specialty'])){
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
    
    
    
    //search
    if(isset($_POST['search']))
    {
        $info = getData();
        $search_query="SELECT * FROM service WHERE id = '$info[0]'";
        $search_result=mysqli_query($conn, $search_query);
    
        if($search_result)
        {
            if(mysqli_num_rows($search_result))
            {
                while($rows = mysqli_fetch_array($search_result))
                {
                    $id = $rows['id'];
                    $First_name = $rows['First_name'];
                    $specialty = $rows['specialty'];
    
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
        $delete_query = "DELETE FROM `service` WHERE id = '$info[0]'";
    
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
        $update_query="UPDATE `service` SET `First_name`='$info[1]',specialty='$info[2]' WHERE id = '$info[0]'";
    
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
                <form action="" method="post">
                <div class="form -row py-3 pt-5">
                        <div class="offset-1 col-lg-10">
                            <input type="text"  value="<?php echo($id);?>"  for="id" class="inp px-3" placeholder="ID" name="id" id="id">
                            
                        </div>
                    </div>
                    
                    <div class="form-group py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="text" value="<?php echo($First_name);?>" for="First_name" class="inp px-3" placeholder="Name" name="First_name" id="First_name">
                        </div>
                    </div>

                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <input type="text" value="<?php echo($specialty);?>" for="specialty" class="inp px-3" placeholder="Specialty" name="specialty" id="specialty">
                        </div>
                    </div>
                   

                    <div class="form -row py-3 ">
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