<?php
	if (session_status() != PHP_SESSION_NONE) {
    session_unset();
	}

	include("db.php");
	if($_POST)
	{
		$errors = array();
		
		if(empty($_POST['firstname']))
		{
			
			$errors['email1'] = "Enter Username";
		
		}
		if(empty($_POST['password']))
		{;
			$errors['pass1'] = "Enter Password";
			
		}
		
		if(count($errors) == 0 )
		{
			
			$firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
			$password=mysqli_real_escape_string($connection,$_POST['password']);
			$sql = "select * from user where name ='$firstname' and password='$password'";
                if($result=(mysqli_query($connection, $sql)))
                {
					
                    if(mysqli_num_rows($result)>0)
                    {
						session_start();
						$_SESSION['POST'] = $_POST;
						
						$row=mysqli_fetch_array($result);
						//print_r( $row );
						if($row['admin_status']==1)
						{
							session_start();
							$_SESSION['firstname'] = $_POST['firstname'];
							
							header("Location:admin_panel.php");
						}
						if($row['admin_status']==0)
							
						{
							session_start();
							$_SESSION['firstname'] = $_POST['firstname'];
							
							header("Location:user_panel.php");
						}
						
						
					}
					
					else 
					{
						$errors['nomatch'] = "Incorrect Username and Password";
						
					}
				}	
                   
                    
                else
                {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                }
 

                mysqli_close($connection);
			
		}
		
	}




?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
	<link rel="stylesheet" href="customStyle.css">
	<link href='https://fonts.googleapis.com/css?family=Lily Script One'rel='stylesheet'>
  </head>
  <body style=" padding-top: 0px ">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #331a00;">
	<div class="container">
	
	
    
	<a class="navbar-brand" style="font-family:Lily Script One;";  href="#"><span class="h1"style="color:red; font-size:2.0em;">M</span>ovie Zip</a>
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Registration</a>
            </li>
            
          </ul>
        </div>
	</nav>
	</div>
	
	<div class="container">
	<div class="row text-center">

      <div class="col-lg-12 col-md-12 mb-12 col-centered">
          
        <form action=# method = "post" class="form-horizontal"  target = "">
            <div class="card-body">
			<h4 class="card-title text-center">Login page</h4>
			
            <div class="form-group text-left">
              <label for="firstname">Username</label>
			  
			  <input class="form-control" placeholder="Login name" type="text" name="firstname"/>
			 <p class="error_red"><?php if(isset($errors['email1'])) echo $errors['email1']; ?></p>
			 </div>
			 
			 
			<div class="form-group text-left">
			  <label for="Password">Password</label>
			  <input class="form-control" placeholder="Password" type="password" name="password"/>
			<p class="error_red"><?php if(isset($errors['pass1'])) echo $errors['pass1']; ?></p> 
			<p class="error_red"><?php if(isset($errors['nomatch'])) echo $errors['nomatch']; ?></p>
			</div>
			
			<input type="submit" name="go" value="Submit" class="btn btn-default"></input>
            
			</div>
            
          
        </div>
		</div>
</div>
     

      
          	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>