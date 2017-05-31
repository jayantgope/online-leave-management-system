<?PHP
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC")
	{	
		$pc_id = $_SESSION['pc_id'];
		
		$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
		
		$sql = "SELECT * FROM lms.leave_requests WHERE leave_status = 'Pending'";
		
		$result = mysql_query($sql, $connection);
		
		$no_of_rows = mysql_num_rows($result);
		
		if($no_of_rows == 0)
		{
			echo 	"<script>
					alert(\"No Leave Requests to Show!\");
					window.location=\"index.html\";</script>";
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
    <div id="heading">Leave Requests Received<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
     <label for="total_leave_requests"><span style="width:300px; margin-left:10px;">Total Requests Received : <?PHP echo $no_of_rows; ?></span>
   	</label>
    <label>
    <div id="table">
    	<span><table border="1" bgcolor="#006699" >
				<tr>
                	<th width="230px">Staff ID</th>
					<th width="100px">Leave Type</th>
					<th width="80px">Start Date</th>
					<th width="90px">No. of Days</th>
					<th width="100px">Date Applied</th>
                    <th width="110px">Approve/Reject</th>
				</tr>
			</table></span>
     <?PHP
		while($row = mysql_fetch_array($result))
		{
			$staff_id = $row['staff_id'];
			$leave_type = $row['leave_type'];
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
			$no_of_days = $row['days_requested'];
			$date_applied = $row['date_applied'];
			$status = $row['leave_status'];
			
			echo "<table border=\"1\">
					<tr>
						<td width=\"230px\">".$staff_id."<a href='staff_profile.php?staff_id=".$staff_id."'\> View Profile</a></td>
						<td width=\"100px\">".$leave_type."</td>
						<td width=\"80px\">".$start_date."</td>
						<td width=\"90px\">".$no_of_days."</td>
						<td width=\"100px\">".$date_applied."</td>
						<td width=\"110px\"><a href='approve_reject_leave.php?staff_id=".$staff_id."&start_date=".$start_date."'\><img src=\"../images/edit_find_replace.png\" />Details</a></td>
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
