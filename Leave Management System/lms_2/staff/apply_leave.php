<?PHP
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "Staff")
	{
		$connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
		$sql = "SELECT * FROM lms.leave_types";
		$result = mysql_query($sql, $connection);
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply Leave</title>
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
<script type="text/javascript" src="../jquery.js"></script>
<script>
	function total_days()
	{
		var start_date = document.getElementById("start_date");
		var end_date = document.getElementById("end_date");
		var start_day = new Date(start_date.value);
		var end_day = new Date(end_date.value);
		var milliseconds_per_day = 1000 * 60 * 60 * 24;
	
		var millis_between = end_day.getTime() - start_day.getTime();
		var days = millis_between / milliseconds_per_day;
	
		// Round down.
		//alert( Math.floor(days));
		
		var total_days = (Math.floor(days)) + 1;
		var combined = total_days;
		//alert(combined);
		//document.getElementById("date").value = (Math.floor(days)) ;
		var days_requested = document.getElementById('days_requested');
		days_requested.value = combined;
	}
	
	$(document).ready(function(){
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="one_day"){
                $(".multiple_days_leave").hide();
                $(".one_day_leave").show();
				$(".leave_type").show();
				$(".leave_requested_days").hide();
				$(".button").show();
            }
            if($(this).attr("value")=="multiple_days"){
                $(".one_day_leave").hide();
                $(".multiple_days_leave").show();
				$(".leave_type").show();
				$(".leave_requested_days").show();
				$(".button").show();
            }
        });
    });
	
	$(document).ready(function(){
    if(!$("input[type=radio][name='leave_duration']:checked").val())
	{
		 $(".one_day_leave").hide();
         $(".multiple_days_leave").hide();
		 $(".leave_type").hide();
		 $(".leave_requested_days").hide();
		 $(".button").hide();
	}
});
</script>
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
    <div id="heading">Apply Leave<hr size="2" color="#FFFFFF" ice:repeating=""/>
</div>
    <form action="apply_leave_db.php" method="post">
   
    	<label for="leave_duration" ><span>Leave Duration <span class="required">*</span></span>
            <input type="radio" value="one_day" name="leave_duration" id="leave_duration" />One Day
            <input type="radio" value="multiple_days" name="leave_duration" id="leave_duration" />Multiple Days
        </label>
        
  	<div class="leave_type" >
        <label for="leave_type" ><span>Leave Type <span class="required">*</span></span>
         	<select name="leave_type" id="leave_type">
		 	<?PHP
           		while ($row = mysql_fetch_array($result))
            	{
                	$leave_type = $row['leave_type'];
                	echo "<option value=\"".$leave_type."\">".$leave_type."</option>";
            	}
          	?>
          	</select>
        </label>
	</div>
    
    <div class="one_day_leave" >
        <label for="leave_date" ><span>Date <span class="required">*</span></span>
        	<input type="date" name="leave_date" id="leave_date" />
        </label>
   	</div>
    
    <div class="multiple_days_leave" >     
        <label for="start_date" ><span>Start Date <span class="required">*</span></span>
        	<input type="date" name="start_date" id="start_date" onchange="total_days()" />
        </label>
        
        <label for="end_date" ><span>End Date <span class="required">*</span></span>
        	<input type="date" name="end_date" id="end_date" onchange="total_days()" />
        </label>
   	</div>
    
    <div class="leave_requested_days" >     
        <label for="days_requested" ><span>Days Requested </span>
        	<input type="text" name="days_requested" id="days_requested" readonly="true" placeholder="No. of Days"/>
        </label>
   	</div>
    
    <div class="button" >
        <label>
          <input type="submit" value="Submit Request" id="submit"/>
        </label>
	</div>
    
    </form>
  </div>
  <div id="side_bar">
  	<ul>
    	<li class="menu_head">Controls</li>

        <li><a href="apply_leave.php">Apply Leave</a></li>
        <li><a href="view_leave_history.php">View Leave History</a></li>
        <li><a href="view_leave_status.php">View Leave Status</a></li>
         <li><a href="view_profile.php">View Profile</a></li>
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
