<?php 

//Starting a client site session
     session_start();

     //setting a cookie
     $sessionID = session_id(); //storing session id for the future Use
 
     setcookie("user_login",$sessionID,time()+3600,"/","localhost",false,true);//cookie terminate itself after 1 hour - HTTP only flag
     
?>


<!DOCTYPE html>
<html>

<head>
    <title>Secure Software Systems - Assignment 1</title>		
<link rel="stylesheet" type="text/css" href="style1.css">
<script type="text/javascript" src="conf.js"> </script>
</head>



<body>
	
	<div class="wrap">


<h1 style="font-size: 35px;text-align:center;color: #dff9fb;text">CSRF Protection via Synchronizer Token</h1>
       
    <hr>

	<h1>Login</h1>
    <form class="login" method="POST" action="server.php">
    	<input type="text" name="user" placeholder="Username" required="required" />
		<input type="password" name="pass" placeholder="Password" required="required" />
		<input type="hidden" name="user_csrf" id="IdOfToken" /> 
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Login.</button>
    </form>

    <p style="font-size: 35px; text-align:center;color: #95afc0">For source Code: <a style="font-size: 35px; text-align:center;color: #dbd523" href="https://github.com/brayanbenett/CSRF-Protection-via-synchronize-token">Brayan Benett's GIT</a></p>
	<p style="font-size: 35px; text-align:center;color: #95afc0">For more Info: <a style="font-size: 35px; text-align:center;color: #dbd523" href="https://lonewolf28.wordpress.com/2018/05/15/cross-site-request-forgerycsrf-protection-via-synchronize-token/">Lonely Wolf 28</a></p>
</div>


<?php 
    //Calling of Ajax
       if(isset($_COOKIE['user_login']))
            { 
        echo '<script> var token = csrfTokenCapture("POST","server.php","IdOfToken");  </script>'; 
                        
            }
    ?>

</body>
</html>
