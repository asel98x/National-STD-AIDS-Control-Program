<?php 
	session_start();
	if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {   ?>
<!doctype html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
  </head>
  <body>

  <section class="login py-5 bg-light">
      <div class="container">
        <div class="row g-0">
            <div class="color col-lg-5 text-center  py-5">
               
                <h1 class="text-light"> National STD/AIDS Control Programme</h1>
                <div class="py-5">
                <a href="signup.html"><button type="submit" class="btn1 text-light">Signup</button></a>
                </div>
            </div>
            
            <div class="col-lg-7 text-center py-5">
                <h1 >LOGIN</h1>
                <form action="php/check-login.php" method="post">
                <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>

                    <div class="form -row py-3 pt-5">
                        <div class="offset-1 col-lg-10">
                                <select class="inp px-3" name="role" aria-label="Default select example">
					                <option selected >- User type -</option>
			  		                <option  value="admin">Admin</option>
			  		                <option value="doctor">Doctor</option>
					                <option value="customer">Customer</option>
		                        </select>
                        </div>
                    </div>
              
                    <div class="form -row py-3 pt-5">
                        <div class="offset-1 col-lg-10">
                            <input type="text" for="username" class="inp px-3" placeholder="Username" name="username" id="username">
                        </div>
                    </div>
                    <div class="form -row">
                        <div class="offset-1 col-lg-10">
                            <input type="password" for="password" class="inp px-3" placeholder="Password" name="password" id="password">
                        </div>
                    </div>
                    <div class="form -row py-3">
                        <div class="offset-1 col-lg-10">
                            <button type="submit" class="btn1">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
  </section>

  

  </body>
</html>
<?php }else{
	header("Location: home.php");
} ?>