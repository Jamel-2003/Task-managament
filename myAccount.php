<?php
session_start();
if(isset($_SESSION['userName']) && isset($_SESSION['pass']))
{
$userName =$_SESSION['userName'];
$password=$_SESSION['pass'];
// $email=$_SESSION['email'];
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
$sql="SELECT * FROM signup WHERE userName='$userName' AND pass='$password' " ; 
$result=$con->query($sql); 
if ($result->num_rows >0)
{
if($row=$result->fetch_assoc())
{

$firstName=$row['Firstname'];
$lastName=$row['Lastname'];
$email=$row['email'];
$BirthDay=$row['BirthDay'];
$Gender=$row['Gender'];

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Account </title>
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
    <!-- Start Navbar -->
<!-- Start NavBar  -->
<nav class="navbar navbar-expand-lg sticky-top ">
  <div class="container">
  <a class="navbar-brand ps-lg-3">
  <img src="images/logo.png">
  </a>
  <button class="navbar-toggler text-white"
  type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" 
    aria-expanded="false"
    aria-label="Toggle navigation">
    <i class="fa-solid fa-bars"></i>  
    </button>

    <div class="collapse navbar-collapse"
    id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item ">
          <a class="nav-link active pe-lg-4 p-2 pe-3 p-lg-3" 
          aria-current="page"
          href="index.php">Home</a>

        </li>
        <li class="nav-item">
        <a class="nav-link p-2 pe-lg-4 p-lg-3" 
        aria-current="page" href="#Services">Services</a>
        </li>

        <li class="nav-item">
          <a class="nav-link p-2 pe-lg-4 p-lg-3" aria-current="page" href="#footer">Contact</a>
        </li>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle pe-lg-4 p-lg-3 p-2"href="#" id="navbarDropdown"
        role="button"
        data-bs-toggle="dropdown"
        aria-expanded="false">
        Tasks </a>

          <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="addTask.php">Add Task <i class="fa-solid fa-circle-plus float-end"></i></a></li>
            <li><a class="dropdown-item" href="editTask.php">Edit Task <i class="fa-solid fa-pen-to-square float-end"></i></a></li>
            <li><a class="dropdown-item" href="detailTask.php">Tasks Detail <i class="fa-solid fa-list float-end pt-1"></i> </a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="search.php">Search  <i class="fa-solid fa-magnifying-glass float-end"></i> </a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
        
        <li class="nav-item ">
          <a class="nav-link pe-lg-4 p-2 p-lg-3" href="Notification.php">
        <i class="fa-regular fa-bell">  </i></a>
        </li>

        

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle p-2 pe-lg-5 p-lg-3 pe-lg-3 "
          href="#" id="navbarDropdown" 
          role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="fa-regular fa-user"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="myAccount.php">Setting<i class="fa-solid fa-gear float-end"></i></a></li>
            <li><a class="dropdown-item" href="logout.php">Logout<i class="fa-solid fa-arrow-right-from-bracket float-end"></i> </a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- End NavBar  --> 

<!-- start myaAccount -->
<div class="container signUp-container">
<form class="signUp-form" method="post" action="<?php echo htmlspecialchars('setting.php');?>" autocomplete="off">
<p class="signUp-title">
<span class="loading">
  <svg height="48px" width="64px">
      <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
    <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
</svg>
</span>
Profile 
</p>
<p style='color:#ffc400;font-size:12px;'>
 Notice :  You can only edit the username and email
</p>

        <div class="flex">
        <label for="firstName">
            <input class="input" type="text" placeholder=""   disabled name="firstName" value="<?php echo $firstName;?>">
            <span>Firstname</span>
        </label>

                
        <label for="lastName">
            <input class="input" type="text" placeholder=""  name="lastName" value="<?php echo $lastName;?>" disabled>
            <span>LastName</span>
        </label>
    </div> 

    <label for="userName">
        <input class="input" type="text" placeholder=""   name="userName" value="<?php echo $userName;?>">
        <span> * UserName</span>
    </label> 
    <label for="email">
        <input class="input" type="email" placeholder=""   name="email" value="<?php echo $email;?>">
        <span> * Email</span>
    </label> 
    <label for="firstName">
        <input class="input" type="text" placeholder=""  name="firstName" value="<?php echo $password;?>" disabled>
        <span>Password</span>
    </label>
    <label for="BirthDay">
        <input class="input" type="BirthDay" placeholder="" required name="BirthDay" value="<?php echo $BirthDay;?>" disabled>
        <span>BirthDay</span>
    </label>
    <label for="Gender">
        <input type="text" class="input" name="Gender" value="<?php echo $Gender;?> " disabled>
        <span > Gender  </span>
        </label>
        <button type="submit"  name="submit" class="sign">Save</button>
    <p class="signIn"><a href="forgotPassword.php">Edit Password ?</a> </p>
    </form>     

</div>
        <!-- Footer -->
<div  id="footer" class="footer pt-5 pb-5 text-white-50 text-center text-md-start">
  <div class="container">
    <div class="row">
<div class="col-md-4 col-lg-4 ps-5">
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
<div class="col-md-4 col-lg-3 ps-5 ps-lg-5 ">
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
</div>
<div class="col-md-4 col-lg-5 ps-lg-4 ps-4 ">
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

</body>
</html>
<?php
}
}
}
else 
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account </title>
</head>
<body>

    <!-- Footer -->
<div  id="footer" class="footer pt-5 pb-5 text-white-50 text-center text-md-start">
  <div class="container">
    <div class="row">
<div class="col-md-4 col-lg-4 ps-5">
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
<div class="col-md-4 col-lg-3 ps-5 ps-lg-5 ">
  <div class="links">
    <h5 class="text-ligth"> Menu</h5>
    <ul class="list-unstyled lh-lg">
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="#Services">Services</a></li>
      <li><a href="addTask.php"> Add Task </a></li>
      <li><a href="editTask.php"> Edit Tasks</a></li>
      <li><a href="detailTask.php"> Task Details</a></li>
      <li><a href="search.php"> Search</a></li>
    </ul>
  </div>
</div>
<div class="col-md-4 col-lg-5 ps-lg-4 ps-4 ">
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
</body>
</html>
<?php
}
?>