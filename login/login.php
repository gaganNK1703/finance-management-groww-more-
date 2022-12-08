<?php
require '../db_connect.php';


if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT * FROM user WHERE email in ('$username')";
    $result=mysqli_query($conn,$sql);
    $det=mysqli_fetch_assoc($result);
     
    if($det!=NULL){


    $sql="SELECT * FROM user WHERE email='$username'";
    $result=mysqli_query($conn,$sql);
    $det=mysqli_fetch_assoc($result);

    $num=mysqli_num_rows($result);

    if($num=1 && password_verify($password,$det['password'])){
        session_start();
        $_SESSION['name']=$det['name'];
        $_SESSION['user']=$det['email'];
        header("location:../dashboard/dashboard.php");
    }
}
else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        Incorrect credential.Try again!!!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
    //adding else part pending
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>LOGIN</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcpdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="login_css1.css">
    </head>
    <body>
        <div class="container">
            <h1>LOGIN</h1>
            <form action="login.php" method="POST">
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
                <input type="submit" value="LOGIN">
            </form>
            <div class="bottom-text">
                <input type="checkbox" name="remember" checked="checked">Remember Me ?
            </div>
        </div>
    </body>

</html>