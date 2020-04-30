<?php session_start();
unset($_SESSION['id']);
if(isset($_SESSION["loggedin"])){
	$_SESSION["loggedin"]=false;
}
if(isset($_SESSION["logged_in"])){
	$_SESSION["logged_in"]=false;
}
unset($_SESSION["username"]);                            
echo "<script>window.location.href='index.php'</script>";?>
