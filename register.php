<?php
  include "db_connect.php";


  if($_SERVER['REQUEST_METHOD']=="POST"){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $hashpassword=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO `user` (`name`, `email`, `password`) VALUES ('$name', '$email', '$hashpassword')";
    $res=mysqli_query($conn,$sql);
    if($res){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hey '.$name.'!</strong> Your account has been registered.Login now!!!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else{
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Hey '.$name.'!</strong> Your account has not been registered. Try again using different email-id!!!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="register.css">
  </head>
  <body>
    <div class="navigationbar">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">GROWW MORE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="home/finalhomepage.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login/login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="register.php">Register</a>
              </li>
              
            </ul>
            
          </div>
        </div>
      </nav>
    </div>
    <div class="container register my-4 ">
    <h1 style="text-align: center;">Please register here!!!</h1>
    <hr>
    <form onsubmit="return validateForm()" action="register.php"  method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" placeholder="Enter your name" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address:</label>
        <input type="email" placeholder="Enter your e-mail" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
        
      </div>
      <div class="mb-4">
        <div id="emailHelp" class="form-text" style="color:white;">Your password must have atleast 8 characters</div>
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <label for="confirmpassword" class="form-label">Confirm Password:</label>
        <input type="password" class="form-control" id="confirmpassword" required>
      </div>
      <input type="reset" class="btn btn-primary">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  

    <script>
      function validateForm(){
          var pass=document.getElementById("password").value;
          var cpass=document.getElementById("confirmpassword").value;
          if(pass.length<8){
            alert("Password length less than 8 characters");
            document.getElementById("password").value="";
            document.getElementById("confirmpassword").value="";
            return false;
          }
          else if(pass!=cpass){
              alert("Passwords do not match");
              document.getElementById("password").value="";
              document.getElementById("confirmpassword").value="";
              return false;
          }

          else{
            return true;
          }
      }
    </script>

  </body>
</html>