<!------------start database connection---------------->
<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="titan";
$conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if(!$conn)
{
die ("connection failed");
}
?>
<!-------------End database connection-------------------->

<!------------------start php code------------------------->
<?php
session_start();
if(!isset($_SESSION['islogin']))
{
if(isset($_REQUEST['rLogin']))
{
if(($_REQUEST['rName']=="")||($_REQUEST['rEmail']=="")||($_REQUEST['rPass']==""))
{
$msg='<div class="alert alert-warning mt-3 text center">Please fill all the fields</div>';
}
else
{
$rName=$_REQUEST['rName'];
$rEmail=$_REQUEST['rEmail'];
$rPass=$_REQUEST['rPass'];
$sql="SELECT rName,rEmail,rPass FROM thanos WHERE rName='".$rName."' AND rEmail='".$rEmail."' AND rPass='".$rPass."'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==1)
{
$_SESSION['rName']=$rName;
$_SESSION['rEmail']=$rEmail;
$_SESSION['islogin']=true;
echo '<script>location.href="profile.php"</script>';
}
else
{
$msg='<div class="alert alert-warning mt-3 text center">Name,Email or password is not valid</div>';
}
}
}
}
else
{
echo '<script>location.href="profile.php"</script>';
}
?>
<!------------------End php code--------------------------->

<!------------------start login form------------------------>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<title>Login.com</title>
</head>
<body>
<div class="container mt-5">
<div class="row">
<div class="col-sm-4">
<form action="" method="POST" class="shadow-lg p-5">
<h4>Welcome to Login page</h4>
<label for="Name">Name</label>
<input type="text" placeholder="Type your name here" name="rName" class="form-control">

<label for="Email">Email</label>
<input type="text" placeholder="Type your email here" name="rEmail" class="form-control">

<label for="Password">Password</label>
<input type="password" placeholder="Type your password here" name="rPass" class="form-control">

<input type="submit" value="Login" name="rLogin" class="btn btn-info">
</form>

<a href="registrationform.php">Back to registration page</a>
</div>
</div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->
</body>
</html>
<!-------------------End login form--------------------------->