<!-------------start database connection--------------->
<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="titan";
$conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if(!$conn)
{
die("connection failed");
}
?>
<!-------------------End database connection--------------->

<!---------------------start php code----------------------->
<?php
session_start();
if(isset($_SESSION['islogin']))
{
$rEmail=$_SESSION['rEmail'];
}
else
{
echo '<script>location.href="login.php"</script>';
}
$sql="SELECT *FROM thanos WHERE rEmail='".$rEmail."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$rName=$row['rName'];
?>
<!------------------------End php code------------------------->

<!----------------start html code------------------------------>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<title>www.WebDeveloperzone.com</title>
</head>
<body>

<div class="container mt-5">
<div class="row">
<div class="col-sm-4">

<div class="form-group">
<label for="Name">Name</label>
<input type="text" placeholder="Type your name here" name="rName" class="form-control"
value="<?php echo $rName; ?>"><br><br>

<div class="form-group">
<label for="Email">Email</label>
<input type="text" placeholder="Type your email here" name="rEmail" class="form-control" 
value="<?php if(isset($rEmail)) {echo $rEmail;} ?>"><br><br>

<a href="logout.php">Logout</a>
<a href="changepass.php">ChangePassword</a>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
-->
</body>
</html>
<!----------------------End html code-------------------------->