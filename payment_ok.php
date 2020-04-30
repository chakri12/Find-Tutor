<?php
include 'db_config.php';
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
    header("location: student_login.php");
    exit;
$errors = array(); 
      $id = $_SESSION['id'];
      $maths = 0;
         if(isset($_POST['maths']))
         {
            $maths =1;
         }
      $physics =0;
         if(isset($_POST['physics']))
         {
            $physics =1;
         } ;
      $chemistry = 0;
         if(isset($_POST['chemistry'])){
            $chemistry=1;
         }
      $months = $_POST['months'];     
     $query=mysqli_prepare($link,"insert into subscription(id,maths,physics,chem,months) values(?,?,?,?,?);");
  mysqli_stmt_bind_param($query,'iiiii',$id,$maths,$physics,$chemistry,$months);
  if(mysqli_stmt_execute($query))
  {
    print_r("Payment Successful");
   } 
    else {
       echo "Error: " . $query . "<br>" . mysqli_error($link);
       $errors= mysqli_error($link);
    }
php?>