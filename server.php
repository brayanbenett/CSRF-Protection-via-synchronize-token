<?php

session_start(); //server session starting point
generateToken(); //create and store token in to a session array

if(isset($_POST['submit']))
{
    ob_end_clean();
    
    validate($_POST['user'],$_POST['pass'],$_POST['user_csrf'],$_COOKIE['user_login']);
}
//create a token by hashing
function generateToken(){

    if(empty($_SESSION['key']))
    {
        $_SESSION['key']=bin2hex(random_bytes(32));  // Generating a random key for hashing     
    }

    $token = hash_hmac('sha256',"token for user login",$_SESSION['key']); 
    $_SESSION['CSRF_TOKEN'] = $token;

    ob_start(); //store  in buffer Memory
    echo $token;
}

//Checking all the variable to allow login
function validate($username, $password,$user_token,$user_sessionCookie)
{

    if($username=="admin" && $password=="admin")
    {
        if($user_token==$_SESSION['CSRF_TOKEN'] && $user_sessionCookie==session_id())
        {
            echo "<script> alert('Logged in Successfully') </script>";
            echo "<h1 style=\"font-size:50px;text-align:center;\">Welcome : ".$username."<br/></h1>";
			echo "<h1 style=\"font-size:50px;text-align:center;\">You have been successfully logged in<br/></h1>";
          
            
        }
        else
        {
           echo "<script> alert('Login failed! CSRFToken not matching!!') </script>"; 
         
           
           echo "<script type=\"text/javascript\"> window.location.href = 'index.php'; </script>";
            
        }   
        
    }
    else{
        echo "<script> alert('Login failed! Check your username, password and login again!!') </script>"; 
           
        echo "<script type=\"text/javascript\"> window.location.href = 'index.php'; </script>";

    }

    
}


?>