<?php 
// to start session
session_start();
// declare variable for form data 
$userName="";
$password="";
$errorMessage=""; 
// to declaere variables for Connection 
$serverName="localhost"; 
$serverUserName="root"; 
$serverPassword=""; 
$dataBaseName="beprogrammerproject";
// to  create a Connection  
$con= new mysqli($serverName,$serverUserName,$serverPassword,$dataBaseName); 
// to Check Connecttion 
if($con->connect_error)
{
    die("Failed Connection !! <br>".$con->connect_error); 
}
else 
{
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    // to collect data from user
$userName=testData($_POST['userName']);
$password=testData($_POST['password']);
// Check if the email and password match any records in the databas
$checkQuery="SELECT userName,pass FROM signup WHERE userName='$userName' AND pass='$password'";
$result = $con->query($checkQuery);
	if ($result->num_rows > 0) 
	{
	  // Login successful, redirect to index page
      // to Store the values of form data in session superglobal 
    $row = $result->fetch_assoc();
    if($row['userName']==$userName && $row['pass']==$password)
    {
        $_SESSION['userName']=$row['userName']; 
        $_SESSION['pass']=$row['pass']; 
        header("Location:index.php");
        exit();
    }
    }
	else
    {
        // Login failed , show an error message
        $errorMessage="*Invalid userName or password .Please try again.";
    }

}
}
function testData($Data)
{
	$Data=trim($Data);
	$Data=stripcslashes($Data); 
	$Data=htmlspecialchars($Data); 
	return $Data; 
}
// Close the database connection
$con->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In </title>
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
<!-- Start Login  -->
<div class="log-in">

        <div class="container login-container">
    <div class="form-container">
        <p class="title">
    <span class="loading">
  <svg height="48px" width="64px">
      <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
    <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
  </svg>
</span>
    Login
        </p>
        <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <div class="input-group">
                <label for="userName"> UserName </label>
                <input type="text" name="userName" id="userName" placeholder="" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="" required>
                <div class="error_message">
			<?php  if (isset($_POST['submit']) && $result->num_rows === 0)
			{
                echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'>".$errorMessage."</p>";
                $errorMessage="";
                // echo "<p style='color:#ffc400;font-size:12px;padding-top:7px'>*Invalid userName or password Please try again.</p>";
            }
				?>
                </div>
                <br>
                <div class="forgot">
                    <!-- this is forget password page  -->
                    <a rel="noopener noreferrer" href="forgotPassword.php"> Forgot Password ?</a>
                </div>
            
            <button type="submit" name="submit" class="sign">Log in</button>
        </form>
        <p class="signup">Don't have an account?
            <a rel="noopener noreferrer" href="signUp.php" class="">Sign up</a>
        </p>
    </div>
    </div>
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