<?php
include 'db_config.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    header("location: student_login.php");
    exit;
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
    <style>
body {margin:0;font-family:Arial}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}
</style>

</head>
<body>
    <div class="topnav" id="myTopnav">
  <a href="student_home.php" class="active">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Post a Doubt 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="maths_doubt.php">Maths</a>
      <a href="physics_doubt.php">Physics</a>
      <a href="chemistry_doubt.php">Chemistry</a> 
 
    </div>
  </div> 
  <a href="subscription.php">Subscription</a>
  <div class="dropdown">
    <button class="dropbtn">My Profile 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="reset_passwd.php">Change Password</a>
      <a href="Logout.php">LogOut</a> 
    </div>
  </div> 
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

    <div class="wrapper">
        <h2>Subscription Plan</h2>
        <!-- <p><b><?php echo $_SESSION['username'] ?> </b>Fill in the form below to subscribe for the subjects on our website.</p> -->
        <form action="payment.php" method="get">
            <p>Hi <b> <?php echo $_SESSION['username'] ?> </b>. Tick on the subjects you are willing to subscribe to.</p>
            <div class="form-group ">
                <input type="checkbox" name="maths" value="1">
                <label>Maths</label>
            </div>    
            
            <div class="form-group ">
                <input type="checkbox" name="physics" value="1">
                <label>Physics</label>
            </div>
            <div class="form-group ">
                <input type="checkbox" name="chemistry"  value="1">
                  <label>Chemistry</label>
            </div>
             <div class="form-group">
                <label>Subscription Duration(in Months)</label>
                <input type="text" name="months" required='true' value=" ">
                
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="subscription">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>   
    <script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

 
</body>
</html>