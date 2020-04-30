<?php
session_start();
ob_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true){
    header("location: tutor_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="z">
    <meta name="author" content="">

    <title>Tutor Home Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/assets/css/business-casual.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
 
  

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link type="text/css" href="/assets/css/schedule.css" rel="stylesheet">
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
  <a href="tutor_home.php" class="active">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Take the test 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="maths_doubt.php">Maths</a>
      <a href="physics_doubt.php">Physics</a>
      <a href="chemistry_doubt.php">Chemistry</a> 
 
    </div>
  </div> 
  <!-- <a href="subscription.php">Subscription</a> -->
  <div class="dropdown">
    <button class="dropbtn">My Profile 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="passwd_reset.php">Change Password</a>
      <a href="bank_details.php">Add bank details</a>
      <a href="logout.php">LogOut</a> 
    </div>
  </div> 
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
<?php
include 'db_config.php';
$solution='';
$q_id = $_GET['ques_id'];  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$solution=$_POST['solution'];
$id = $_SESSION['id'];
$query=mysqli_prepare($link,"update ques set tut_id=?,solution=?,issolved=1 where ques_id=?;");
  mysqli_stmt_bind_param($query,'isi',$id,$solution,$q_id);
  if(mysqli_stmt_execute($query))
  {
    header("location: tutor_home.php");
    print_r("Question solved successfully.");
    
  }

    else {
       echo "Error: " . $query . "<br>" . mysqli_error($link);
       $errors= mysqli_error($link);
    }

}
?>
<h2>Question:</h2>
<p><?php 
  $query=mysqli_query($link,"select question from ques where ques_id=".$_GET['ques_id']."");
  while($row = mysqli_fetch_row($query))
    {
      echo $row[0];
    }
// echo $_GET['ques_id'];
    ob_end_flush();
 ?>
</p>
<form method="post" action="">  
  <h2>Solution</h2>
  <textarea name="solution" rows="25" cols="100"><?php echo $solution;?></textarea>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

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