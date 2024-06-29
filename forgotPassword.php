<?php
// Assuming you have a MySQL database set
// up with a table named 'signup' and columns 'FirstName' and 'LastName' and 'userName'and 'password'
// declare variable for form data 
session_start();
$userName="";
$Password="";
$ConfirmPassword="";
$errorMessage="";
$flag="1"; 

// to declaere variables for Connection 
$serverName="localhost"; 
$serverUserName="root"; 
$serverPassword=""; 
$dataBaseName="beprogrammerproject";
// to  create a Connection  
$con= new mysqli($serverName,$serverUserName,$serverPassword,$dataBaseName); 
// to create filter on data 
function testData($Data)
{
	$Data=trim($Data);
	$Data=stripcslashes($Data); 
	$Data=htmlspecialchars($Data); 
	return $Data; 
}
// to Check Connecttion 
if($con->connect_error)
{
    die("Failed Connection !! <br>".$con->connect_error); 
}
else
{
    if ($_SERVER['REQUEST_METHOD']=='POST') 
    {
        $userName=testData($_POST['userName']);
        $Password=testData($_POST['password']);
        $ConfirmPassword=testData($_POST['Cpass']);


        $checkQuery="SELECT userName FROM signup WHERE userName='$userName'"; 
        $result = $con->query($checkQuery);
        // Check if the email already exists in the database or not 
        if ($result->num_rows > 0) 
        {
            if ($Password===$ConfirmPassword)

            {
                $flag="1";
                $upDate="UPDATE signup SET pass='$Password' WHERE userName='$userName'";
                if ($con->query($upDate) === TRUE) {
                    $errorMessage="* Password updated successfully";
                    } 

            }
            else 
            {
                $flag="0"; 
                $errorMessage=" *Doesn't Match password ";

            }
        }
        else
        {
            $errorMessage="*Doesn't found userName";
        }

}
	    // Close the database connection
	$con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password </title>
    <!-- This url for add a bootstrap framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- This url for connect a external css style for whole website  -->
    <link rel="stylesheet" href="css/project.css">
    <!-- This is fontawesom links  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- google font url -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet" />
</head>
<body>
    <!-- Start NavBar  -->
<nav class="navbar navbar-expand-lg sticky-top ">
  <div class="container">
  <a class="navbar-brand ps-lg-3">
  <img src="images/logo.png">
  </a>
  </div>
</nav>
<!-- End NavBar  -->
<div class="container forgotPassword-container">
<form class="forgot-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
    <p class="forgot-title">
    <span class="loading">
  <svg height="48px" width="64px">
      <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
    <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
  </svg>
</span>    
    Reset password 
</p>    
<div class="input-group">

    <label for="userName"> UserName   </label> 
        <input class="input" type="userName" placeholder="" required name="userName">
</div>
<div class="input-group">

        <label for="Password"> New Password    </label> 

        <input class="input" type="password" placeholder="" required name="password">
</div>
<div class="input-group">

        <label for="Cpass"> Confirm password    </label>
        <input class="input" type="password" placeholder="" required name="Cpass">
        <div class="error_message">
    <?php 
    
        if (isset($_POST['submit'])&& $result->num_rows > 0)
        {
            if($flag==1)
            {
                echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'>".$errorMessage."</p>";
                // echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'> *Password updated successfully";

            }
            else
            {
                echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'>".$errorMessage."</p>";

                // echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'> *Doesn't Match password";

            }
        }
                // if (isset($_POST['submit'])&& $result->num_rows === 0)
        else 
        {
            echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'>".$errorMessage."</p>";
            // echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'> *Doesn't found email";
        }?>
    </div>
    </div>
<div class="input-group">

    <button type="submit"  value="" class="sign">SAVE</button>
    <p class="signup"> Don't have an account?<a href="login.php"> Login </a> </p>
    </div>
</form>     
</div>

<!-- Footer -->
<div  id="footer" class="footer pt-5 pb-5 text-white-50 text-center text-md-start">
  <div class="container">
    <div class="row">
<div class="col-md-6 col-lg-6 ps-5">
  <div class="info mb-5">
    <img src="images/logo.png" alt="" class="mb-5">
  <div class="copy-right">
    Created By <span> Jamel Al-shalabe </span>
    <div>
      &copy; 2024 - <span> Task Management</span>
    </div>
  </div>
  </div>

</div>

<div class="col-md-6 col-lg-6 ps-lg-4 ps-4 ">
<div class="contact">
  <h5 class="text-ligth">Contact US </h5>
  <p class="lh-lg mt-3 ">
    Get in touch
    with us via social media 
  </p>
  <ul class="d-flex mt-3 list-unstyled gab-5">
    <li>
    <a class="d-block text-ligth"href="https://www.facebook.com/jamel.alshalabe?mibextid=ZbWKwL">
    <i class="fa-brands fa-facebook fa-lg facebook rounded-circle p-2"></i>
  </a>
</li>
    <li>
      <a class="d-block text-ligth" href="https://www.instagram.com/jamel_alshalabe?utm_source=qr&igsh=dTdzNmp3aWpodm5s">
        <i class="fa-brands fa-instagram fa-lg instagram rounded-circle p-2"></i>
      </a>
    </li>
    <li>
      <a class="d-block text-ligth " href="https://www.snapchat.com/add/jamel_alshalabe?share_id=nD-8EAqZ98M&locale=ar-AA">
        <i class="fa-brands fa-snapchat fa-lg snapchat rounded-circle p-2"></i>
      </a>
      </li>
    <li>
      <a class="d-block text-ligth " href="https://www.linkedin.com/in/jamel-alshalabe-93008b270?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">
      <i class="fa-brands fa-linkedin fa-lg linkedin rounded-circle p-2"></i>
    </a>
  </li>
  </ul>
</div>
</div>
    </div>
  </div>
</div>
<!-- End Footer -->
</body>
</html>