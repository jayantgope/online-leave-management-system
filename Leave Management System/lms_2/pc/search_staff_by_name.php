<?PHP
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC")
	{	
		$pc_id = $_SESSION['pc_id'];
		$name= $_POST['name'];
		
		$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
		
		$sql = "SELECT * FROM lms.staff WHERE first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%'" ;
		
		$result = mysql_query($sql, $connection);
		if(mysql_num_rows($result)==0)
		{
			echo 	"<script>
					alert(\"Search results not found !\");
					window.location=\"search_staff_to_view_history.php\";</script>";
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Leave History</title>
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
  <div id="content_panel">
    <div id="heading">Search Results<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
    <label>
    <div id="table">
    	<span><table border="1" bgcolor="#006699" >
				<tr>
                	<th width="200px">Staff ID</th>
					<th width="200px">Name</th>
					<th width="200px">View Leave History</th>
				</tr>
			</table></span>
     <?PHP
		while($row = mysql_fetch_array($result))
		{
			$staff_id = $row['staff_id'];
			$first_name = $row['first_name'];
			$middle_name = $row['middle_name'];
			$last_name = $row['last_name'];
			
			echo "<table border=\"1\">
					<tr>
						<td width=\"200px\"><a href='staff_profile.php?staff_id=".$staff_id."' >".$staff_id."</a></td>
						<td width=\"200px\">".$first_name." ".$middle_name." ".$last_name."</td>
						<td width=\"200px\"><a href='view_leave_history.php?staff_id=".$staff_id."'\><img src=\"../images/edit.png\" />View History</a></td>
					</tr>
				</table>";
		}
	?>
    </label>
  </div>
  </div>
  <div id="side_bar">
  	<ul>
    	<li class="menu_head">Controls</li>
        <li><a href="view_leave_requests.php">View Leave Request</a></li>
        <li><a href="search_staff_to_view_history.php">View Leave History</a></li>
    </ul>
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
	mysql_close($connection);
?>
