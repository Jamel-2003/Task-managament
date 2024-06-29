<?php
session_start();
$UserName = $_SESSION['userName'];
$userName =$_POST['userName'];
$email = $_POST['email'];


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

    $select="SELECT email FROM signup WHERE userName='$UserName' ";
    $result2=$con->query($select);
$row=$result2->fetch_assoc();
$Email=$row['email'];
$query = "UPDATE signup SET userName ='$userName' WHERE email='$Email'";
$result = $con->query($query);

$query="UPDATE signup SET email='$email' WHERE userName ='$userName'";
$result = $con->query($query);


$sql = "UPDATE usertasks SET userName='$userName' WHERE userName='$UserName'";
$result=$con->query($sql);

$query = "SELECT * FROM signup WHERE userName ='$userName' AND email ='$email' ";
$result = $con->query($query);
if($result->num_rows>0)
{
$row = $result->fetch_assoc();

if($row['userName']===$userName && $row['email']===$email)
{

$_SESSION['userName'] = $row['userName'];

header("Location:myAccount.php");
exit;
}
}

}
?>