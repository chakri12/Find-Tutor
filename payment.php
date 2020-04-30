<?php
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
    header("location: student_login.php");
    exit;
}
include "db_config.php";
$bill_name_err = $bill_email_err =$bill_addr_err= $bill_city_err = $bill_state_err = $bill_zip_err="";
$card_name_err = $card_card_err = $card_month_err = $card_year_err = $card_cvv_err = "";
$bill_name = $bill_email = $bill_addr = $bill_zip= $bill_city= $bill_state="";
$card_name = $card_card = $card_month = $card_year =$card_cvv= ""; 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["firstname"]))){
        $bill_name_err = "Please enter a name for the Billing.";
    } else{
        $bill_name = trim($_POST["firstname"]);
    }
    if(empty(trim($_POST["email"]))){
        $bill_name_err = "Please enter your email address.";
    } else{
        $bill_email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["address"]))){
        $bill_addr_err = "Please enter valid address.";
    } else{
        $bill_addr = trim($_POST["address"]);
    }

    if(empty(trim($_POST["city"]))){
        $bill_city_err = "Please enter your city.";
    } else{
        $bill_city = trim($_POST["city"]);
    }
    if(empty(trim($_POST["state"]))){
        $bill_state_err = "Please enter your state name.";
    } else{
        $bill_state = trim($_POST["state"]);
    }
    if(empty(trim($_POST["zip"]))){
        $bill_zip_err = "Please enter zip code.";
    } else{
        $bill_zip = trim($_POST["zip"]);
    }

    if(empty(trim($_POST["cardname"]))){
        $card_name_err = "Please enter the name on your card.";
    } else{
        $card_name = trim($_POST["email"]);
    }
    if(empty(trim($_POST["cardnumber"]))){
        $card_card_err = "Please enter a valid card number.";
    } else{
        $card_card = trim($_POST["cardnumber"]);
    }
    if(empty(trim($_POST["expmonth"]))){
        $card_month_err = "Please enter the exp Month on your card.";
    } else{
        $card_month = trim($_POST["expmonth"]);
    }
    if(empty(trim($_POST["expyear"]))){
        $card_year_err = "Please enter the exp year on your card.";
    } else{
        $card_year = trim($_POST["expyear"]);
    } 
    if(empty(trim($_POST["cvv"]))){
        $card_cvv_err = "Please enter the cvv of your card.";
    } else{
        $card_cvv = trim($_POST["cvv"]);
    }
    $bill_details =true;
    $card_details = true;
    $bill_details = empty($bill_name_err) && empty($bill_zip_err) && empty($bill_state_err) && empty($bill_city_err) && empty($bill_addr_err) && empty($bill_zip_err);
    $card_details = empty($card_cvv_err) && empty($card_year_err) && empty($card_month_err) && empty($card_name_err) && empty($card_card_err);
    if($bill_details && $card_details){
      header("location: student_home.php");
    }
    else
    {
      echo "Oops! Something went wrong. Please try again later.";
      header('location: subscription.php');
    }
}
?>
<?php 
      $errors = array(); 
      $id = $_SESSION['id'];
      $maths = 0;
      $physics =0;
      $chemistry = 0; 
      $m=0;if(isset($_GET['maths'])){$m=100*$_GET['months'];}
      $p=0;if(isset($_GET['physics'])){$p=100*$_GET['months'];}
      $c=0;if(isset($_GET['chemistry'])){$c=100*$_GET['months'];}
      $total=$p+$c+$m;
      
        if(isset($_GET['maths']))
         {
            $maths =1;
            // echo 'math';
         }
         if(isset($_GET['physics']))
         {
            $physics =1;
            // echo 'phy';
         } 
         if(isset($_GET['chemistry'])){
            $chemistry=1;
            // echo 'chem';  
         }
      $months = $_GET['months'];     
      $query=mysqli_prepare($link,"insert into subscription(id,maths,physics,chem,months) values(?,?,?,?,?);");
      if(mysqli_stmt_bind_param($query,'iiiii',$id,$maths,$physics,$chemistry,$months))
        {
          // echo 'eexc';
        }
      if(mysqli_stmt_execute($query))
      {
        // print_r("Complete Payment  ");
       } 

        else {
           echo "Error: " . $query . "<br>" . mysqli_error($link);
           $errors= mysqli_error($link);
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

<h2>Payment Portal</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method = "post">    
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname">
            <span class="help-block" color='red'><?php echo $bill_name_err; ?></span>

            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email">
            <span class="help-block" color='red'><?php echo $bill_email_err; ?></span>
  
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address">
            <span class="help-block" color='red'><?php echo $bill_addr_err; ?></span>
            
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city">
            <span class="help-block" color='red'><?php echo $bill_city_err; ?></span>
            
            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state">
                <span class="help-block" color='red'><?php echo $bill_state_err; ?></span>    
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip">
                <span class="help-block" color='red'><?php echo $bill_zip_err; ?></span>      
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname">
            <span class="help-block" color='red'><?php echo $card_name_err; ?></span>       
            
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber">
            <span class="help-block" color='red'><?php echo $card_card_err; ?></span>       
            
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth">
            <span class="help-block" color='red'><?php echo $card_month_err; ?></span>       
            
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear">
                <span class="help-block" color='red'><?php echo $card_year_err; ?></span>       
            
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv">
                <span class="help-block" textcolor='red'><?php echo $card_cvv_err; ?></span>       
            
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" value="Submit" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b></b></span></h4>
      <p>Maths<span class="price"><?php echo $m;?></span></p>
      <p>Physics<span class="price"><?php echo $p;?></span></p>
      <p>Chemistry<span class="price"><?php echo $c;?></span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b><?php echo $total;?></b></span></p>
    </div>
  </div>
</div>

</body>
</html>
