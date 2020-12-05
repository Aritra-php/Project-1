<!-------------start php code for database connection----------------->
<?php
$my_host="localhost";
$my_user="root";
$my_pass="";
$my_name="titan";
$conn=mysqli_connect($my_host,$my_user,$my_pass,$my_name);
if(!$conn)
{
die("Connection falied");
}
else
{
echo "Connected";
}
?>
<!-----------------End php code for database connection------------------>

<!-----------------start php code for input data-------------------------->
<?php
if(isset($_REQUEST['rReg']))
{
if(($_REQUEST['rName']=="")||($_REQUEST['rEmail']=="")||($_REQUEST['rPass']=="")||($_REQUEST['rConPass']=="")||empty($_REQUEST['rGender'])||($_REQUEST['rCity']=="")||empty($_REQUEST['rRep']))
{
$msg='<div class="alert alert-warning mt-3 text-center">Please fill all the fields</div>';
}
else
{
$rName=$_REQUEST['rName'];
$rEmail=$_REQUEST['rEmail'];
$rPass=$_REQUEST['rPass'];
$rConPass=$_REQUEST['rConPass'];
$rGender=$_REQUEST['rGender'];
$rCity=$_REQUEST['rCity'];
$rRep=$_REQUEST['rRep'];
$rFinalRep=implode(',',$rRep);
$sql="SELECT rEmail FROM thanos WHERE rEmail='".$rEmail."'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==1)
{
$msg='<div class="alert alert-warning mt-3 text center">Email already registered</div>';
}
else
{
if($rPass==$rConPass)
{
$sql="INSERT INTO thanos(rName,rEmail,rPass,rConPass,rGender,rCity,rRep)VALUES('$rName','$rEmail','$rPass','$rConPass','$rGender','$rCity','$rFinalRep')";
if(mysqli_query($conn,$sql))
{
$msg='<div class="alert alert-secondary mt-3 text center">Data inserted successfully</div>';
}
}
else
{
$msg='<div class="alert alert-warning mt-3 text center">Password and confirm password must be same</div>';
}
}
}
}
?>
<!-----------------End php code for input data----------------------------->

<!-------------------start userregistration form--------------------------->
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<title>project1.com</title>
</head>
<body>
<div class="container mt-5">
<div class="row">
<div class="col-sm-4">

<?php
$a=[];
$b=[];
if(isset($_REQUEST['Edit']))
{
$Srno=$_REQUEST['Srno'];
$sql="SELECT *FROM thanos WHERE Srno='".$Srno."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$a=$row['rRep'];
$b=explode(',',$a);
}
?>

<form action="" method="POST" class="shadow-lg p-5">
<h4>Welcome to registration page</h4>

<div class="form-group">
<label for="Name">Name</label>
<input type="text" placeholder="Type your name here" name="rName" class="form-control"
value="<?php if(isset($row['rName'])) {echo $row['rName'];}?>">
</div>

<div class="form-group">
<label for="Email">Email</label>
<input type="text" placeholder="Type your email here" name="rEmail" class="form-control"
value="<?php if(isset($row['rEmail'])) {echo $row['rEmail'];}?>">
</div>

<div class="form-group">
<label for="Password">Password</label>
<input type="password" placeholder="Type your password here" name="rPass" class="form-control"
value="<?php if(isset($row['rPass'])) {echo $row['rPass'];}?>">
</div>

<div class="form-group">
<label for="Confirm Password">Confirm Password</label>
<input type="password" placeholder="confirm your password here" name="rConPass" class="form-control"
value="<?php if(isset($row['rConPass'])) {echo $row['rConPass'];}?>">
</div>

<div class="form-group">
<label for="Gender">Gender</label>
Male<input type="radio" name="rGender" value="Male" class="form-inline"
<?php if(isset($row['rGender']) && $row['rGender']=="Male") {echo "checked";}?>>

Female<input type="radio" name="rGender" value="Female" class="form-inline"
<?php if(isset($row['rGender']) && $row['rGender']=="Female") {echo "checked";}?>>

Others<input type="radio" name="rGender" value="Others" class="form-inline"
<?php if(isset($row['rGender']) && $row['rGender']=="Others") {echo "checked";}?>>
</div>

<div class="form-group">
<label for="City">City</label>
<select name="rCity" class="form-inline">
<option vlaue=""></option>
<option value="Durgapur"
<?php if(isset($row['rCity']) && $row['rCity']=="Durgapur") {echo "selected";}?>>Durgapur</option>

<option value="Kolkata"
<?php if(isset($row['rCity']) && $row['rCity']=="Kolkata"){echo "selected";}?>>Kolkata</option>

<option value="Burdwan"
<?php if(isset($row['rCity']) && $row['rCity']=="Burdwan") {echo "selected";}?>>Burdwan</option>

<option value="Asansol"
<?php if(isset($row['rCity']) && $row['rCity']=="Asansol") {echo "selected";}?>>Asansol</option>
</select>
</div>

<div class="form-group">
<label for="currently repairing produncts">Currently repairing products</label>
Keyboard<input type="checkbox" value="Keyboard" name="rRep[]" class="form-inline"
<?php if(in_array('Keyboard',$b)) {echo "checked";}?>>

Mouse<input type="checkbox" value="Mouse" name="rRep[]" class="form-inline"
<?php if(in_array('Mouse',$b)) {echo "checked";}?>>

Camera<input type="checkbox" value="Camera" name="rRep[]" class="form-inline"
<?php if(in_array('Camera',$b)) {echo "checked";}?>>

Laptop<input type="checkbox" value="Laptop" name="rRep[]" class="form-inline"
<?php if(in_array('Laptop',$b)) {echo "checked";}?>>
</div>

<input type="submit" value="Register" name="rReg" class="btn btn-info">
<input type="hidden" name="Srno" value="<?php if(isset($row['Srno'])) {echo $row['Srno'];}?>">
<input type="submit" value="Update" name="update" class="btn btn-info">
<?php if(isset($msg)) {echo $msg;}?>


</form>
<a href="login.php">Login</a>
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
<!-------------------End userregistration form------------------------------>
<!-------------------start php code for fetch data-------------------------->
<?php
$sql="SELECT *FROM thanos";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
echo '<table border="3">';
echo "<tr>";
echo "<thead>";
echo "<th>Name</th>";
echo "<th>Email</th>";
echo "<th>Pass</th>";
echo "<th>ConPass</th>";
echo "<th>Gender</th>";
echo "<th>City</th>";
echo "<th>Rep</th>";
echo "<th>Delete</th>";
echo "<th>Edit</th>";
echo "</thead>";
echo "</tr>";
echo "<tbody>";
while($row=mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>".$row['rName']."</td>";
echo "<td>".$row['rEmail']."</td>";
echo "<td>".$row['rPass']."</td>";
echo "<td>".$row['rConPass']."</td>";
echo "<td>".$row['rGender']."</td>";
echo "<td>".$row['rCity']."</td>";
echo "<td>".$row['rRep']."</td>";
echo '<td><form action="" method="POST">
<input type="hidden" name="Srno" value='.$row['Srno'].'>
<input type="submit" value="Delete" name="Delete">
</form></td>';

echo '<td><form action="" method="POST">
<input type="hidden" name="Srno" value='.$row['Srno'].'>
<input type="submit" value="Edit" name="Edit">
</form></td>';

echo "</tr>";
}
echo "</tbody>";
echo "</table>";
}
else
{
echo "No data found";
}
?>
<!-------------------End php code for fetch data---------------------------->
<!-------------------Start php code for delete button----------------------->
<?php
if(isset($_REQUEST['Delete']))
{
$Srno=$_REQUEST['Srno'];
$sql="DELETE FROM thanos WHERE Srno='".$Srno."'";
if(mysqli_query($conn,$sql))
{
$msg='<div class="alert alert-secondary mt-3 text center">Data Deleted successfully</div>';
}
else
{
$msg='<div class="alert alert-warning mt-3 text center">unable to Delete data</div>';
}
}
?>
<!-------------------End php code for delete button------------------------->
<!-------------------start php code for update button----------------------->
<?php
if(isset($_REQUEST['update']))
{
if(($_REQUEST['rName']=="")||($_REQUEST['rEmail']=="")||($_REQUEST['rPass']=="")||($_REQUEST['rConPass']=="")||empty($_REQUEST['rGender'])||($_REQUEST['rCity']=="")||empty($_REQUEST['rRep']))
{
echo "Please fill all the fields";
}
else
{
$Srno=$_REQUEST['Srno'];
$rName=$_REQUEST['rName'];
$rEmail=$_REQUEST['rEmail'];
$rPass=$_REQUEST['rPass'];
$rConPass=$_REQUEST['rConPass'];
$rGender=$_REQUEST['rGender'];
$rCity=$_REQUEST['rCity'];
$rRep=$_REQUEST['rRep'];
$rFinalRep=implode(',',$rRep); 
$sql="UPDATE thanos SET rName='$rName',rEmail='$rEmail',rPass='$rPass',rConPass='$rConPass',
rGender='$rGender',rCity='$rCity',rRep='$rFinalRep' WHERE Srno='".$Srno."'";
if(mysqli_query($conn,$sql))
{
echo "Data updated successfully";
}
else
{
echo "Unable to update data";
}
}
}
?>
<!-------------------End php code for update button------------------------->