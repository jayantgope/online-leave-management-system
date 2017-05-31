<?php
	
	// Obtaining connection
	$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
	
	
	// Sql query
	$sql = "SELECT * FROM lms.leave_types";
	//$sql2 = "SELECT COUNT(*) FROM lms.staff WHERE first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%'" ;
	//$sql2 = "SELECT password FROM login WHERE name = '$staff_id'"; 
	
	
	// Firing query
	$result = mysql_query($sql, $connection);
	//$result2 = mysql_query($sql2, $connection);
	//$result2 = odbc_exec($connection, $sql2);
	
	if(mysql_num_rows($result)==0)
	{
		echo 	"<script>
				alert(\"Search results not found !\");
				window.location=\"#\";</script>";
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
<title>Delete Leave Type</title>
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
    <div id="heading">Types of Leave
      <hr size="2" color="#FFFFFF" ice:repeating=""/>
    </div>
    <div id="table">
    	 <?PHP
			echo "<span><table border=\"1\" bgcolor=\"#006699\" >
				<tr>
					<th width=\"150px\">Type of Leave</th>
					<th width=\"150px\">Number of Leaves</th>
					<th width=\"100px\">Delete</th>
				</tr>
			</table></span>";
			while($row = mysql_fetch_array($result))
			{
				$leave_type = $row['leave_type'];
				$no_of_leaves = $row['no_of_days'];
				echo "<table border=\"1\">
						<tr>
							<td width=\"150px\">".$leave_type."</td>
							<td width=\"150px\">".$no_of_leaves."</td>
							<td width=\"100px\"><a href='delete_leave_type_db.php?leave_type=".$leave_type."'\><img src=\"../images/trash.gif\" />Delete</a></td>
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
		header("Location: ../index.html");
	}
?>
