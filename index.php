<?php
// to start a session variable 
session_start();
// to check if the userName and Password not empty 
if(isset($_SESSION['userName']) && isset($_SESSION['pass']))
{
// to store a sission variable 
$userName=$_SESSION['userName'];
$password=$_SESSION['pass'];
$serverName="localhost"; 
$serverUserName="root"; 
$serverPassword=""; 
$dataBaseName="beprogrammerproject";
// to  create a Connection  
$con= new mysqli($serverName,$serverUserName,$serverPassword,$dataBaseName); 
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
$sql="SELECT * FROM userTasks WHERE userName='$userName'";
$result =$con->query($sql); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Task Management  </title>
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

<!-- Start Landing  -->
<div class="landing d-flex justify-content-center align-items-center">
  <div class="text-center text-light ">
<h1 class="mb-3 shadow__btn">Task Management</h1>
<p class="text-black-50 mt-4">
  Task management involves 
  organizing , prioritizing ,
  and tracking tasks<br>
  to efficiently accomplish 
  goals or projects.
</p>
<a href="#tasks" class="btn main-btn rounded-pill log mb-5">Show Yor Tasks</a>
</div>
  </div>
<!-- End Landing  -->

<!-- Start Services -->
<div class="Services text-center pt-2 pb-2" id="Services">
<div class="container">
  <div class="main-title mt-5 mb-5 position-relative">
    <img class="mb-2" src="images/title.png">
    <h2>We are Good at </h2>
    <p class="text-black-50 text-uppercase">Some Of These Stuff Under</p>
  </div>
  <div class="row pt-5">
    <div class="col-lg-4 col-md-6 ">
      <div class="feat">
<div class="icon-holder position-relative">
<i class="fa-solid fa-1 position-absloute botton-0 number"></i>
<i class="fa-solid fa-pencil fa-4x position-absloute botton-0 icon"></i>
</div>
<h4 class="mb-3 mt-3 text-uppercase"> Add Task </h4>
<p class="text-black-50 lh-md mb-5">
  An add task service is a feature or
  tool that allows users to input and 
  create new tasks within a task management
  system or application.
</p>
<a href="addTask.php" class="btn main-btn rounded-pill log mb-5".
style="background-color: var(--yellow-color);
    color:var(--dark-color);
    padding: 0.5rem 1rem;">
    Add Task</a>

      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="feat">
<div class="icon-holder position-relative">
<i class="fa-solid fa-2 position-absloute botton-0 number"></i>
<i class="fa-solid fa-pen-to-square fa-4x position-absloute botton-0 icon"></i>
</div>
<h4 class="mb-3 mt-3 text-uppercase">Edit Task  </h4>
<p class="text-black-50 lh-md mb-4">
An edit task service allows
users to modify and update 
existing tasks within a task
  management system, enhancing flexibility and adaptability 
in managing projects and responsibilities.
</p>
<a href="editTask.php" class="btn main-btn rounded-pill log mb-5".
style="background-color: var(--yellow-color);
    color:var(--dark-color);
    padding: 0.5rem 1rem;">
    Edit Task</a>
      </div>
</div>

<div class="col-lg-4 col-md-6">
      <div class="feat">
<div class="icon-holder position-relative">
<i class="fa-solid fa-3 position-absloute botton-0 number"></i>
<i  class="fa-solid fa-bell fa-4x position-absloute botton-0 icon"></i>
</div>
<h4 class="mb-3 mt-3 text-uppercase"> Task Notification </h4>
<p class="text-black-50 lh-md mb-5">
A notification task is a function
 or process designed to alert
 users or systems about important 
 information or events via notifications.
</p>
<a href="notification.php" class="btn main-btn rounded-pill log mb-5 ".
style="background-color: var(--yellow-color);
    color:var(--dark-color);
    padding: 0.5rem 1rem;">
    Task Notification</a>
      </div>

    </div>
  </div>
</div>
</div>

<!-- End Services -->


<!-- Start Cards  -->
<div class="cards pt-5 pb-5 " id="tasks">
  <div class="container tasks pt-5">
    <div class="heading text-center text-dark pb-5">
      <h1>All Tasks </h1>
    </div>
    <div class="row">
      <?php
      $cards="";
      while($row=$result->fetch_assoc())
      {
        if(ucfirst($row['priorityTask'])=="Critical")
        {
          $cards="
          <div class='col-xl-3 col-lg-4 col-md-6 p-lg-3 p-md-5 mb-5'>
          <div class='card'>
          <div class='img'>
          <img src='images/cards.png' width='250px' height='130px'>
          </div>
          <div class='text pt-3'>
          <p class='h3'>Task Name : ". 
          $row['taskName'].
          "
          </p>
            <p class='p text-black-50'> Task Expiration Date : ".$row['taskExpirationDate']." </p>
            <p class='p text-black-50'> Task Catagory :".$row['taskCatagory']." </p>
            <p class='p text-black-50'>Task priority :".$row['priorityTask']."</p>
          </div>
          </div>
        
          </div>
          ".$cards;
          
        }
        else
      {
        // this state we are concatination the variable due 
        // hight priority in the first and low priority in the last  
        $cards=$cards."
          <div class='col-xl-3 col-lg-4 col-md-6 p-lg-3 p-md-5 mb-5'>
          <div class='card'>
          <div class='img'>
          <img src='images/cards.png' width='250px' height='130px'>
          </div>
          <div class='text pt-3 '>
          <p class='h3'>Task Name : ". 
          $row['taskName'].
          "
          </p>
          <p class='p text-black-50'> Task Expiration Date : ".$row['taskExpirationDate']." </p>
          <p class='p text-black-50'> Task Catagory :".$row['taskCatagory']." </p>
          <p class='p text-black-50'>Task priority :".$row['priorityTask']."</p>
          </div>
          </div>
        
          </div>
          ";
      }


      }      
      echo $cards;
      ?>

<a href='detailTask.php' class='btn main-btn rounded-pill log mb-5' 
          style='background-color: var(--yellow-color);
          color:var(--dark-color);'>
  Show Detail  
  </a>
    </div>
    
  </div>
  
</div>




<!-- End Cards  -->


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
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Task Management  </title>
    <!-- this url for add a bootstrap framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- This url for connect a external css style for whole website  -->
    <link rel="stylesheet" href="css/project.css">
    <!-- this is fontawesom links  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- google font url -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet" />
</head>
<body>
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
      </ul>
      <a href="login.php" class="btn main-btn rounded-pill log">Login</a>
    </div>
  </div>
</nav>

<!-- Start Landing  -->
<div class="landing d-flex justify-content-center align-items-center">
<div class="text-center text-light ">
<h1 class="mb-3 shadow__btn">Task Management</h1>
<p class="text-black-50 mb-3 pt-3  ">
  Task management involves 
  organizing , prioritizing ,
  and tracking tasks<br>
  to efficiently accomplish 
  goals or projects.
</p>
<a href="login.php" class="btn main-btn rounded-pill log mb-5">Get Started</a>
</div>
  </div>
<!-- End Landing  -->


<!-- Start Services -->
<div class="Services text-center pt-2 pb-2" id="Services">
<div class="container">
  <div class="main-title mt-5 mb-5 position-relative">
    <img class="mb-2" src="images/title.png">
    <h2>We are Good at </h2>
    <p class="text-black-50 text-uppercase">Some Of These Stuff Under</p>
  </div>
  <div class="row pt-5">
    <div class="col-lg-4 col-md-6 ">
      <div class="feat">
<div class="icon-holder position-relative">
<i class="fa-solid fa-1 position-absloute botton-0 number"></i>
<i class="fa-solid fa-pencil fa-4x position-absloute botton-0 icon"></i>
</div>
<h4 class="mb-3 mt-3 text-uppercase"> Add Task </h4>
<p class="text-black-50 lh-md">
  An add task service is a feature or
  tool that allows users to input and 
  create new tasks within a task management
  system or application.
</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="feat">
<div class="icon-holder position-relative">
<i class="fa-solid fa-2 position-absloute botton-0 number"></i>
<i class="fa-solid fa-pen-to-square fa-4x position-absloute botton-0 icon"></i>
</div>
<h4 class="mb-3 mt-3 text-uppercase">Edit Task  </h4>
<p class="text-black-50 lh-md">
An edit task service allows
users to modify and update 
existing tasks within a task
  management system, enhancing flexibility and adaptability 
in managing projects and responsibilities.
</p>
      </div>
</div>

<div class="col-lg-4 col-md-6">
      <div class="feat">
<div class="icon-holder position-relative">
<i class="fa-solid fa-3 position-absloute botton-0 number"></i>
<i  class="fa-solid fa-bell fa-4x position-absloute botton-0 icon"></i>
</div>
<h4 class="mb-3 mt-3 text-uppercase"> Task Notification </h4>
<p class="text-black-50 lh-md mb-5">
A notification task is a function
 or process designed to alert
 users or systems about important 
 information or events via notifications.
</p>


    </div>
  </div>
</div>
</div>
</div>
<!-- End Services -->

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
<?php
}
?>
