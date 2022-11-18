<?php
 include('includes/customer_header.php'); 

 $servername = "localhost";
 $username="root";
 $password="";
 $dbname="my_db";
 
 $patient="";
 $doctor="";
 $date="";
 $message = "";
 
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
     $data[0]=$_POST['patient'];
     $data[1]=$_POST['doctor'];
     $data[2]=$_POST['date'];
     $data[3]=$_POST['message'];
 
     return $data;
 }
 
 //insert (insert data into table doctor)
 if(isset($_POST['insert'])){
     if(!empty ($_POST['patient']) && !empty ($_POST['doctor']) && !empty ($_POST['date']) && !empty ($_POST['message'])){
 
         $info = getData();
         $insert_query="INSERT INTO `appointments`(`patient`, `doctor`, `date`, `message`) VALUES ('$info[0]','$info[1]','$info[2]','$info[3]')";
     
     
     }
     
     try{
        if(!empty ($_POST['patient']) && !empty ($_POST['doctor']) && !empty ($_POST['date']) && !empty ($_POST['message'])){
 
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
 
 
 ?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="CSS/admin-docter-manage.css">
 <main>
         <article>
         
             
             
             <div class=" text-center ">
                 <form action="make_appoiment_db.php" method="post">
                 <div class="form -row py-3 pt-5">
                         <div class="offset-1 col-lg-10">
                             <input type="text"  value="<?php echo($patient);?>"  for="patient" class="inp px-3" placeholder="patient" name="patient" id="patient">
                             
                         </div>
                     </div>
                     <div class="form-group py-3">
                         <div class="offset-1 col-lg-10">
                             <input type="text" value="<?php echo($doctor);?>" for="doctor" class="inp px-3" placeholder="doctor" name="doctor" id="doctor">
                         </div>
                     </div>
                     <div class="form-group py-3">
                         <div class="offset-1 col-lg-10">
                             <input type="date" value="<?php echo($date);?>" for="date" class="inp px-3" placeholder="Date" name="date" id="date">
                         </div>
                     </div>
                     <div class="form -row">
                         <div class="offset-1 col-lg-10">
                             <input type="text" value="<?php echo($message);?>" for="message" class="inp px-3" placeholder="message" name="message" id="message">
                         </div>
                     </div>
 
                     <div class="form -row py-3">
                         <div class="offset-1 col-lg-10">
                             <a href=""><button type="submit" name="insert" class="btn1">Save</button></a>
                         </div>
                     </div>
                 </form>
        
         </article>
     </main>
     <?php include('includes/footer.php'); ?>