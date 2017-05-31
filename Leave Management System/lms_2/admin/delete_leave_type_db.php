<?PHP
	$leave_type = $_GET['leave_type'];
	$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
	$sql1 = "DELETE FROM lms.leave_types WHERE leave_type = '".$leave_type."'";
	$sql2 = "DELETE FROM lms.leave_requests WHERE leave_type = '".$leave_type."'";
	$sql3 = "DELETE FROM lms.leave_statistics WHERE leave_type = '".$leave_type."'";
	echo 	"<script>
				alert(\"Do you really want to delete Leave Type = ".$leave_type."\");
			</script>";
	mysql_query($sql1, $connection);
	mysql_query($sql2, $connection);
	mysql_query($sql3, $connection);
	echo "<script>window.location=\"delete_leave_type.php\";</script>";
	//header ("Location: delete_staff.php"); 
	mysql_close($connection);

?> 