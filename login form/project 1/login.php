<?php 
 
 session_start();

?>

<?php
require_once './dbcon.php';
//session_start();
if(isset($_SESSION["user_login"])){
    header("location: ../index.php");
 }
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $username_check = mysqli_query($link,"SELECT * FROM `users` WHERE `username` = '$username'");
    if(mysqli_num_rows($username_check)>0){
        $row= mysqli_fetch_assoc($username_check);
        if($row['password'] == $password){
            if(isset($row['status']) == 'active'){
                $_SESSION["user_login"] = $username;
                    header("location: index.php");
            }else{
                $status_error='your account inactive';
            }
        }else{
            $wrong_password = 'Password dosnt match';
        }
    }else{
        $username_error = 'This username not found';
    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    


<form class="box" action="login.php" method="POST">

    <h1>Login</h1>
    <input type="text" value="<?php if(isset($username)) echo $username;  ?> name="username" id="username" placeholder="Username" require="">
    <input type="password" value="<?php if(isset($password)) echo $password;  ?> name="password" id="password" placeholder="password" require="">
    <input type="submit" value="Login" name="login>


    <?php if(isset($username_error)){echo '<div class="alert alert-danger col-md-5">'.$username_error.'</div>';} ?>
     <?php if(isset($wrong_password)){echo '<div class="alert alert-danger col-md-5">'.$wrong_password.'</div>';} ?>
     <?php if(isset($status_error)){echo '<div class="alert alert-danger col-md-5">'.$status_error.'</div>';} ?>


</form>

</body>
</html>