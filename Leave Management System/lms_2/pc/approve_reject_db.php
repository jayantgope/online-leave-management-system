<?PHP
	$staff_id = $_POST['staff_id'];
	$status = $_POST['approve_reject'];
	$no_of_days = $_POST['no_of_days'];
	$leave_type = $_POST['leave_type'];
	$leave_applied = $_POST['date_applied_on'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	
	$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
	
	$sql1 = "UPDATE lms.leave_requests SET leave_status = '".$status."' WHERE staff_id = '".$staff_id."' AND leave_type = '".$leave_type."' AND date_applied = '".$leave_applied."' AND start_date = '".$start_date."' AND end_date = '".$end_date."'";
	
	if($status == "Approved")
	{
		$sql2 = "SELECT * FROM lms.leave_statistics WHERE staff_id = '".$staff_id."' AND leave_type = '".$leave_type."' limit 1";
		
		$result1 = mysql_query($sql2, $connection);
		if($result1 === FALSE) { 
    			die(mysql_error()); // TODO: better error handling
			}
		
		
		$row = mysql_fetch_array($result1);
		$initial_number = $row['leaves_taken'];
		
		$no_of_days = $no_of_days + $initial_number;
		$sql3 = "UPDATE lms.leave_statistics SET leaves_taken = '".$no_of_days."' WHERE staff_id = '".$staff_id."' AND leave_type = '".$leave_type."'";
	}
	
	mysql_query($sql1, $connection);
	mysql_query($sql3, $connection);
		echo 	"<script>
				alert(\"Leave ".$status.".\");
				window.location=\"view_leave_requests.php\";</script>";
?>