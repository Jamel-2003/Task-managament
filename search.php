<?php
session_start();
if(isset($_POST['submit']))
{
$userName=$_SESSION['userName'];
$serverName="localhost"; 
$serverUserName="root"; 
$serverPassword=""; 
$dataBaseName="beprogrammerproject";
$flag="1";
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
else
{
    $select=testData($_POST['task']);

    $search=testData($_POST['Search']); 
    $sql=" SELECT * FROM userTasks WHERE userName='$userName' AND $select='$search' ";
    $result=$con->query($sql);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  Task Search  </title>
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
  <div class="search pt-1 pb-5 " style=
  "width: 400px;
        margin: 100px auto;
        height: 300px;
        background-color: #19283f;
        color: #33d1cc;
        padding: 50px;
        border-radius: 10px;  
  ">
<div class="container pt-4 pb-5">
  <h1 class="text-center pb-3 ">Search</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
<label for="task" class="mb-2">Task Information : </label><br>
<select  name="task" class="mb-4" id="taskCatagory" required style="
    width: 100%;
    padding: 12px 16px;
    border-radius: 8px;
    color: #fff;
    font-family: inherit;
    background-color: rgba(17, 24, 39, 1);
    border: 1px solid #414141;
    font-size:0.9rem" >
                <option value="taskName" >Task Name </option>
                <option value="taskCatagory">Task Category</option>
                <option value="taskExpirationDate">Task Expiration Date</option>
                <option value="priorityTask">Task Priority</option>
              </select>
        <input class="form-control me-3 mb-3" class="d-flex" type="search" name="Search" 
        style="width:300px; 
        border-radius:20px;
        background-color: rgba(17, 24, 39, 1);
        color:#fff;
" 
        placeholder="Search"
        aria-label="Search">
        <button class="btn main-btn rounded-pill log" type="submit" name="submit" 
        style='background-color: var(--yellow-color);
        color:var(--dark-color);padding:0.3rem'>
            Search
        </button> 
    </form>
</div>
</div>

<!-- Start Cards  -->
<div class="cards pb-5 " id="tasks">
    <div class="container tasks ">
    
    <div class="row">
<?php
// isset($_POST['submit'])&& $result===true

        if($result->num_rows>0)
        {
            $cards="";
            while($row=$result->fetch_assoc())
        {
        if(ucfirst($row['priorityTask'])=="Critical")
            {
            $cards=" "."
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
            </div>";
        }
        }      

        echo $cards;
    }
    else
    {
        echo "*Not found tasks";
    }
        ?>
    </div>
    </div>
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
else 
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  Task Search  </title>
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
  <div class="search pt-1 pb-5 " style=
  "width: 400px;
        margin: 100px auto;
        height: 300px;
        background-color: #19283f;
        color: #33d1cc;
        padding: 50px;
        border-radius: 10px;  
  ">
<div class="container pt-4 pb-5">
  <h1 class="text-center pb-3 ">Search</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
<label for="task" class="mb-2">Task Information : </label><br>
<select  name="task" class="mb-4" id="taskCatagory" required style="
    width: 100%;
    padding: 12px 16px;
    border-radius: 8px;
    color: #fff;
    font-family: inherit;
    background-color: rgba(17, 24, 39, 1);
    border: 1px solid #414141;
    font-size:0.9rem" >
                <option value="taskName" >Task Name </option>
                <option value="taskCatagory">Task Category</option>
                <option value="taskExpirationDate">Task Expiration Date</option>
                <option value="priorityTask">Task Priority</option>
              </select>
        <input class="form-control me-3 mb-3" class="d-flex" type="search" name="Search" 
        style="width:300px; 
        border-radius:20px;
        background-color: rgba(17, 24, 39, 1);
        color:#fff;
" 
        placeholder="Search"
        aria-label="Search">
        <button class="btn main-btn rounded-pill log " type="submit" name="submit" 
        style='background-color: var(--yellow-color);
        color:var(--dark-color);padding:0.3rem'>
            Search
        </button> 
    </form>
</div>
</div>


<div class="cards pt-5 pb-5 " id="tasks">
    <div class="container tasks pt-5">
    <div class="heading text-center text-dark  pt-5 pb-5">
        </div>
    <div class="row">
    </div>
    </div>
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