<?php
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
    header("location: student_login.php");
    exit;
}
include "db_config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  echo "Hi";
  $id=$_SESSION['id'];
  $query=mysqli_query($link,"select * from bank_details where id=".$id."");
  if(mysqli_num_rows($query)==0)
  {

      $query=mysqli_prepare($link,"insert into bank_details(id,bank_name,acc_no,ifsc) values(?,?,?,?);");
      mysqli_stmt_bind_param($query,'isis',$_SESSION['id'],$_POST['br_name'],$_POST['acc_no'],$_POST['ifsc']);
      if(mysqli_stmt_execute($query))
      {
        print_r("Bank details updated successfully");
         header("location: tutor_home.php");
      } 
      else {
           echo "Error: " . $query . "<br>" . mysqli_error($link);
           $errors= mysqli_error($link);
        }
  }
  else{
      $query=mysqli_prepare($link,"update bank_details set bank_name=?,acc_no=?,ifsc=? where id=?;");
      mysqli_stmt_bind_param($query,'sisi',$_POST['br_name'],$_POST['acc_no'],$_POST['ifsc'],$_SESSION['id']);
      if(mysqli_stmt_execute($query))
      {
        print_r("Bank details added successfully");
         header("location: tutor_home.php");
      } 
        else {
           echo "Error: " . $query . "<br>" . mysqli_error($link);
           $errors= mysqli_error($link);
        }
    }
  }
?>

 
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}
.help-block{
  color:red;
}
hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<h2>Hi <?php echo $_SESSION['username']; ?>! Enter Your Bank details here</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method = "post">    
        <div class="row">
          <div class="col-50">
            <label for="name">Name of the Account Holder</label>
            <input type="text" id="name" name="username" required>
            <!-- <span class="help-block" color='red'><?php echo $card_name_err; ?></span>        -->
            <!--  -->
            <label for="acc_no">Account number</label>
            <input type="text" id="acc_num" name="acc_no" required>
            <!-- <span class="help-block" color='red'><?php echo $card_card_err; ?></span>        -->
            
            <label for="ifsc">IFSC Code</label>
            <input type="text" id="ifsc" name="ifsc" required>
            <!-- <span class="help-block" color='red'><?php echo $ifsc_err; ?></span>        -->
            
            <div class="row">
              <div class="col-50">
                <label for="br_name">Branch Name</label>
                <input type="text" id="br_name" name="br_name" required>
                <!-- <span class="help-block" color='red'><?php echo $card_year_err; ?></span>        -->
              </div>
              
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" value="Submit" class="btn">
      </form>
    </div>
  </div>
</div>

</body>
</html>
