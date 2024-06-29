<?php

// declare variable for form data 
$Firstname="";
$Lastname="";
$userName="";
$BirthDay="";
$Gender="";
$email="";
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
        $FirstName=testData($_POST['Firstname']);
        $LastName=testData($_POST['Lastname']);
        $email=testData($_POST['email']);
        $userName=testData($_POST['userName']);
        $Password=testData($_POST['pass']);
        $ConfirmPassword=testData($_POST['Cpass']);
        $BirthDay=testData($_POST['BirthDay']);
        $Gender=testData($_POST['Gender']);
    
        if ($Password===$ConfirmPassword)
        {
          $flag="1";
            $checkQueryEmail="SELECT email FROM signup WHERE 
            email='$email'"; 
            $result = $con->query($checkQueryEmail);
            if ($result->num_rows > 0) 
            {
                $errorMessage= " Email already exists . Please choose a different Email";
            }
            else
            {
              $checkQueryUserName="SELECT userName FROM signup WHERE 
              userName='$userName'"; 
              $result2 = $con->query($checkQueryUserName);
              if($result2->num_rows>0)
              {
                $errorMessage= " userName already exists . Please choose a different UserName";

              }
              else
              {
                $sql=" INSERT INTO signup (Firstname,Lastname,BirthDay,Gender,email,userName,pass)
                VALUES ('$FirstName','$LastName','$BirthDay','$Gender','$email','$userName','$Password')"; 
                if($con->query($sql)===true)
                    {
                    $errorMessage="*Registeration Done Successfully";
                    }
              }
                
    
            }
        }
        else
        {          
            $flag="0"; 
             $errorMessage=" *Doesn't Match password ";
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
    <title>Sign Up </title>
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

    <div class="container signUp-container">
<form class="signUp-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
<p class="signUp-title">
<span class="loading">
  <svg height="48px" width="64px">
      <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
    <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
</svg>
</span>
Register
</p>
        <div class="flex">
        <label for="Firstname">
            <input class="input" type="text" placeholder="" required  name="Firstname">
            <span>Firstname</span>
        </label>

        <label for="Lastname">
            <input class="input" type="text" placeholder="" required name="Lastname">
            <span>Lastname</span>
        </label>
    </div> 
    <label for="userName">
        <input class="input" type="text" placeholder="" required name="userName">
        <span>userName</span>
    </label> 
    <label for="email">
        <input class="input" type="email" placeholder="" required name="email">
        <span>Email</span>
    </label> 
    <label for="pass">
        <input class="input" type="password" placeholder="" required name="pass">
        <span>Password</span>
    </label>
    <label for="Cpass">
        <input class="input" type="password" placeholder="" required name="Cpass">
        <span>Confirm password</span>
    </label>
    <label for="BirthDay">
        <input class="input" type="date" placeholder="" required name="BirthDay">
        <span>BirthDay</span>
    </label>
    
    <label for="Gender">
    <span > Gender : </span>
    <input  class="gender" type="radio" placeholder="" required name="Gender" value="Male" >

    <label >Male</label>
    <input  class="gender" type="radio" placeholder="" required name="Gender" value="FeMale">

        <label >Female</label>
    </label>
    <div class="error_message">
    <?php 
    if ($flag=="1")
    {
        if (isset($_POST['submit']) && $result->num_rows > 0)
        {
            echo "<p style='color:#ffc400;font-size:12px;'>".$errorMessage."</p>";
            $errorMessage=" ";
        }
        elseif (isset($_POST['submit']) && $result2->num_rows > 0)
        {
            echo "<p style='color:#ffc400;font-size:12px;'>".$errorMessage."</p>";
            $errorMessage=" ";
        }
        else if (isset($_POST['submit']) && $result->num_rows === 0)
        {
            echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'>".$errorMessage. "</p>";
            $errorMessage=" ";
        }
    }
    else 
    {
        echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'>".$errorMessage ."</p>";
        $errorMessage=" ";

    }	
				?>
    </div>
    
    <button type="submit"  name="submit" class="sign">Sign up</button>
    <p class="signIn">Already have an acount ? <a href="login.php">login</a> </p>
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
<!-- <div class="col-md-4 col-lg-3 ps-5 ps-lg-5 ">
  <div class="links">
    <h5 class="text-ligth"> Menu</h5>
    <ul class="list-unstyled lh-lg">
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="#Services">Services</a></li>
      <li><a href="addTask.php"> Add Task </a></li>
      <li><a href="editTask.php"> Edit Tasks</a></li>
      <li><a href="deleteTask.php"> Delete Tasks</a></li>
      <li><a href="searchTask.php"> Search</a></li>
    </ul>
  </div>
</div> -->
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