<?PHP
	$staff_id = $_GET['staff_id'];
	$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
	$sql1 = "DELETE FROM lms.staff WHERE staff_id = '".$staff_id."'";
	$sql2 = "DELETE FROM lms.login WHERE user_id = '".$staff_id."'";
	$sql3 = "DELETE FROM lms.leave_requests WHERE staff_id = '".$staff_id."'";
	$sql4 = "DELETE FROM lms.leave_statistics WHERE staff_id = '".$staff_id."'";
	echo 	"<script>
				alert(\"Do you really want to delete Staff ID = ".$staff_id."\");
			</script>";
	mysql_query($sql1, $connection);
	mysql_query($sql2, $connection);
	mysql_query($sql3, $connection);
	mysql_query($sql4, $connection);
	echo 	"<script>
				alert(\"Staff Deleted.\");
			</script>";
	echo "<script>window.location=\"search_staff_for_deletion.php\";</script>";
	//header ("Location: delete_staff.php"); 
	mysql_close($connection);

?> 