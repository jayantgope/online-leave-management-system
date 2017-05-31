<?php
	// Retrieving values from textboxes
	
	$name= $_POST['name'];
	
	/*$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$last_name = $_POST['last_name'];
	$email_id = $_POST['email_id'];
	$password = $_POST['password'];
	$user_type = "Staff";*/
	
	// Obtaining connection
	$connection = @mysql_connect("localhost", "root", "");
	
	
	// Sql query
	$sql1 = "SELECT * FROM lms.staff WHERE first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%'" ;
	//$sql2 = "SELECT COUNT(*) FROM lms.staff WHERE first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%'" ;
	//$sql2 = "SELECT password FROM login WHERE name = '$staff_id'"; 
	
	
	// Firing query
	$result1 = mysql_query($sql1, $connection);
	//$result2 = mysql_query($sql2, $connection);
	//$result2 = odbc_exec($connection, $sql2);
	
	if(mysql_num_rows($result1)==0)
	{
		echo 	"<script>
				alert(\"Search results not found !\");
				window.location=\"search_staff_for_updation.php\";</script>";
	}
?>
<?php
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin")
	{
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Assign PC</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(../images/bg.gif);
}
</style>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">
  <div id="header">
    <div id="title">Leave Management System</div>
    <div id="quick_links">
   	  <ul>
        	<li><a class="home" href="index.php">Home</a></li>
            <li>|</li>
           
        <li><a class="logout" href="../logout.php">Logout</a></li>
         <li>|</li>
        <li><a class="greeting" href="#">Hi <?php echo $_SESSION['user']; ?></a></li>
      </ul>
    </div>
  </div>
  <div id="side_bar">
  	<ul>
    	<li class="menu_head">Controls</li>
        <li><a href="add_staff.php">Add Staff</a></li>
        <li><a href="search_staff_for_updation.php">Update Staff</a></li>
        <li><a href="search_staff_for_deletion.php">Delete Staff</a></li>
    	<li><a href="add_leave.php">Add Leave</a></li>
        <li><a href="delete_leave_type.php">Delete Leave</a></li>
        <li><a href="search_staff_to_assign_pc.php">Program Coordinator</a></li>
    </ul>
  </div>
  <div id="content_panel">
    <div id="heading">Assign Program Coordinator
      <hr size="2" color="#FFFFFF" ice:repeating=""/>
    </div>
    <div id="table">
    	 <?PHP
		echo "<span><table border=\"1\" bgcolor=\"#006699\" >
				<tr>
					<th width=\"200px\">Staff ID</th>
					<th width=\"100px\">First Name</th>
					<th width=\"100px\">Middle Name</th>
					<th width=\"100px\">Last Name</th>
					<th width=\"100px\">Password</th>
					<th width=\"80px\">Assign</th>
				</tr>
			</table></span>";
		while($row1 = mysql_fetch_array($result1))
	{
		$staff_id = $row1['staff_id'];
		$first_name = $row1['first_name'];
		$middle_name = $row1['middle_name'];
		$last_name = $row1['last_name'];
		
		$sql3 = "SELECT password FROM lms.login WHERE user_id = '".$staff_id."'";
		$result2 = mysql_query($sql3, $connection);
		if($row2 = mysql_fetch_array($result2))
		{
			$password = $row2['password'];
		}
		echo "<table border=\"1\">
				<tr>
					<td width=\"200px\">".$staff_id."</td>
					<td width=\"100px\">".$first_name."</td>
					<td width=\"100px\">".$middle_name."</td>
					<td width=\"100px\">".$last_name."</td>
					<td width=\"100px\">".$password."</td>
					<td width=\"80px\"><a href='assign_pc_db.php?staff_id=".$staff_id."'\><img src=\"../images/edit.png\" />Assign</a></td>
				</tr>
			</table>";
			
	}
	mysql_close($connection);
	?>
    </div>

  </div>
  <div id="footer">
  	<p><br />&copy; J!N 2015, All Rights Reserved.</p>
  </div>
</div>
</body>
</html>
<?php
	}
	else
	{
		header("Location:../index.html");
	}
?>
