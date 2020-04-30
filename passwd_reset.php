<?php
session_start(); 
$username = $_SESSION["username"];   
if(!isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] != true){
    header("location: tutor_login.php");
    exit;
}                         
// echo $username;
// Include config file
include "db_config.php";
$old_password = $new_password = $confirm_password = "";
$username_err = $old_password_err = $new_password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
       
    if(empty(trim($_POST["old_password"]))){
        $old_password_err = "Please enter your current password.";
    } else{
        $old_password = trim($_POST["old_password"]);
    }
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter your new password.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if($new_password != $confirm_password){
            $confirm_password_err = "Password did not match.";
        }
    }

    
    if(empty($old_password_err) && empty($new_password_err) && empty($confirm_password_err)){
        // echo 'No errors';
        $username =$_SESSION["username"];
        $sql = "SELECT passwd FROM tutor WHERE username ='$username' ";  
        // echo $username;
        $query = mysqli_query($link ,$sql);
        if(empty($query)){
            // echo "No result";   
        }
        $res = mysqli_fetch_assoc($query);
         $passwd = $res['passwd'];  
        if(empty($res)) 
        {
            // echo "res empty!";
        }     
        // echo $passwd;
        if($old_password == $passwd)
        {
            $sql = "update tutor set passwd= ? WHERE username = ?";

        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $param_passwd,$param_username);
        $param_username = $username;
        $param_passwd = $new_password;
        mysqli_stmt_execute($stmt);
        $message = 'Password successfully changed!';
        echo $message;
        // sleep(10);
        header("location: tutor_home.php");
        }
        else
        {
            // echo $old_password;
            // echo $passwd;
            $old_password_err = "The current password you entered was not valid.";
        }
             
    }
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Hi <?php echo $_SESSION['username'] ?>! Reset your password below.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($old_password_err)) ? 'has-error' : ''; ?>">
                <label>Current Password</label>
                <input type="text" name="old_password" class="form-control" value="<?php echo $old_password; ?>">
                <span class="help-block"><?php echo $old_password_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Change Passsword">
            </div>
            <p> <a href="tutor_home.php">Go back to home page!</a>.</p>
        </form>
    </div>    
</body>
</html>