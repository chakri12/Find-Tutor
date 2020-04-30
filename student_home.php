<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    header("location: student_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
<h2>My Questions</h2>
<div class="container">
       <div class="row ">
     <div class="table-responsive">
        <table class="table table-bordered table-responsive table-hover">
      <thead>
        <tr>
          <th>Question Id</th>
          <th>subject</th>
          <th>Question</th>
          <th>Solution</th>
          <th>Rate Tutor</th>
        </tr>
      </thead>
        <?php include "db_config.php";?>
        <?php
        $query=mysqli_query($link,"select ques_id,subject,question,solution,issolved from ques where stu_id=".$_SESSION['id'].";");
          while($row = mysqli_fetch_row($query))
          {
          $ques_id=$row[0];
          $question=substr($row[2],0,15);
          $subject=$row[1];
          $solution='';
          if(strlen($row[3])!=0)
          {
            $solution=substr($row[3],0,15);
          }
          $solved=$row[4];
          echo "<tr>";
          //$matchdata=json_encode($row);
          if($solved==1){
              echo "<td><a href=complete_sol.php?ques_id=".$ques_id.">". $ques_id . "</td>";
              echo "<td>" . $subject . "</td>";
              echo "<td><a href=complete_sol.php?ques_id=".$ques_id.">" . $question . "</td>";
              echo "<td><a href=complete_sol.php?ques_id=".$ques_id.">" . $solution . "</td>";
              echo "<td><a href=rate_tutor.php?ques_id=".$ques_id.">Rate Tutor</td>";
              echo "</tr>";
            }
            else{
            
              echo "<td>". $ques_id . "</td>";
              echo "<td>" . $subject . "</td>";
              echo "<td>" . $question . "</td>";
              echo "<td>" . $solution . "</td>";
              echo "<td>Rate Tutor</td>";
              echo "</tr>";
            }
          }

        ?>
    </table>
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
