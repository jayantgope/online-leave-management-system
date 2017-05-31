<?PHP
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC")
	{	
		$pc_id = $_SESSION['pc_id'];
		$staff_id = $_GET['staff_id'];
		$start_date = $_GET['start_date'];
		
		$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
		
		$sql1 = "SELECT * FROM lms.leave_requests WHERE staff_id = '".$staff_id."' AND start_date = '".$start_date."'";
		$sql2 = "SELECT first_name, middle_name, last_name FROM lms.staff WHERE staff_id = '".$staff_id."'";
		
		$result1 = mysql_query($sql1, $connection);
		$result2 = mysql_query($sql2, $connection);
		
		$no_of_rows = mysql_num_rows($result1);
		
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
    <div id="heading">Leave Requests Details<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
    <?PHP
		while($row = mysql_fetch_array($result1))
		{
			$staff_id = $row['staff_id'];
			$leave_type = $row['leave_type'];
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
			$no_of_days = $row['days_requested'];
			$date_applied = $row['date_applied'];
			$status = $row['leave_status'];
		}
		while($row1 = mysql_fetch_array($result2))
		{
			$first_name = $row1['first_name'];
			$middle_name = $row1['middle_name'];
			$last_name = $row1['last_name'];
		}
	?>
    <div id="form">
    <form method="post" action="approve_reject_db.php">
    <fieldset>
    <legend>General Information</legend>
    <label for="staff_id"><span>Staff ID </span>
    	<input type="text" name="staff_id" id="staff_id" readonly="true" value="<?php echo $staff_id ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    <label for="staff_name"><span>Staff Name </span>
    	<input type="text" readonly="true" value="<?php echo $first_name." ".$middle_name." ".$last_name ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    </fieldset>
    <br />
    <fieldset>
    <legend>Leave Information</legend>
    <label for="leave_type"><span>Leave Type </span>
    	<input type="text" name="leave_type" id="leave_type" readonly="true" value="<?php echo $leave_type ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    <label for="date_applied"><span>Leave Applied on </span>
    	<input type="text" name="date_applied_on" id="date_applied_on" readonly="true" value="<?php echo $date_applied ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    <label for="leave_date"><span>Leave Date </span>
    	<input type="text" name="start_date" id="start_date" readonly="true" value="<?php echo $start_date ?>" style="background-color:#F6F6F6; color:#069" /> &ndash; <input type="text" name="end_date" id="end_date" readonly="true" value="<?php echo $end_date ?>" style="background-color:#F6F6F6; color:#069" /><input type="text" name="no_of_days" id="no_of_days" readonly="true" value="<?PHP echo $no_of_days ?> Day(s)" style="background-color:#F6F6F6; color:#069; width:80px; margin-left:10px;" />
        
    </label>
    </fieldset>
    
    <br />
    
    <fieldset>
    <legend>Approve/Reject Leave</legend>
    <label for="current_leave_status"><span>Current Status </span>
    	<input type="text" readonly="true" value="<?php echo $status ?>" style="background-color:#F6F6F6; color:#069"/>
    </label>
    <label for="approve_reject"><span>Approve / Reject </span>
    	<select name="approve_reject" id="approve_reject">
            <option value="Approved">Approve</option>
            <option value="Rejected">Reject</option>
        </select>
    </label>
    <label>
    	<input type="submit" value="Submit" />
  	 </label>
    </fieldset>
    </form>
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
