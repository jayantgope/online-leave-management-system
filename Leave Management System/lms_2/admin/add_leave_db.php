<?PHP	
	$leave_type = $_POST['type_of_leave'];
	$number_of_days = $_POST['number_of_leaves'];
	
	$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
	
	//for primary key varification
	$sql1 = "SELECT leave_type FROM lms.leave_types WHERE leave_type = '".$leave_type."'";
	
	// firing query
	$result1 = mysql_query($sql1, $connection);
	
	if(mysql_num_rows($result1))
	{
		echo	"<script>
				alert(\"'".$leave_type."' already exist !\");
				window.location=\"add_leave.php\";</script>";
	}
	else
	{
		$sql2 = "INSERT INTO lms.leave_types VALUES ('".$leave_type."', '".$number_of_days."')";
		$sql3 = "SELECT staff_id FROM lms.staff";
		$result2 = mysql_query($sql3, $connection);
		while($row = mysql_fetch_array($result2))
		{
			$staff_id = $row['staff_id'];
			$sql4 = "INSERT INTO lms.leave_statistics (staff_id, leave_type, maximum_leaves) VALUES( '".$staff_id."', '".$leave_type."', '".$number_of_days."')";
			mysql_query($sql4, $connection) or die(mysql_error());
		}
		
		mysql_query($sql2, $connection) or die(mysql_error());
		echo	"<script>
				alert(\"New Leave Added and Leave Type is '".$leave_type."'\");
				window.location=\"add_leave.php\";</script>";
	}
	mysql_close($connection);
	
?>