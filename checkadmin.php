<?php include 'dbcon.php';?>
<?php

   if(!empty($_POST['username']) && !empty($_POST['password'])) {  
       $user=$_POST['username'];  
       $pass=$_POST['password'];  

        
     
       $query=mysqli_query($conn,"SELECT admin.adm_id,admin.passwd,role.role_name FROM admin,role,user_role WHERE adm_id='".$user."' AND passwd='".$pass."' and  user_role.user_id='".$user."' and role.role_id=user_role.role_id");  
       $numrows=mysqli_num_rows($query);  
       if($numrows!=0)  
       {  
       while($row=mysqli_fetch_assoc($query))  
       {  
       $dbusername=$row['adm_id'];  
       $dbpassword=$row['passwd'];
       $dbrole=$row['role_name'];	   
       }  
     
       if($user == $dbusername && $pass == $dbpassword)  
       {		   
       session_start();  
       $_SESSION['sess']=$dbrole;
	   
     
       /* Redirect browser */  
     //   echo "successfully logged in";
    	  header("Location: admin_home.php");  
       }  
       }
	   else {
			echo "Invalid";
       echo "<script>alert('Invalid Login Credentials');
       window.location.href='admin_login.php';</script>"; 
       }  
     
   } else {  
       echo "<script>alert('All fields are required!');
       window.location.href='admin_login.php';</script>"; 
   }  
   
   
   
   
   ?>

