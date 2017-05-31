<?php
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin")
	{
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Staff</title>
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
    <div id="heading">Add Staff<hr size="2" color="#FFFFFF" ice:repeating=""/>
</div>
    <form action="add_staff_db.php" method="post">
        <label for="full_name" ><span>Name <span class="required">*</span></span>
          <input type="text" name="first_name" id="first_name" placeholder="First" required="required"/>
          <input type="text" name="middle_name" id="middle_name" placeholder="Middle"/>
          <input type="text" name="last_name" id="last_name" placeholder="Last" required="required"/>
        </label>
         <label for="email_id" ><span>Email ID <span class="required">*</span></span>
          <input type="email" name="email_id" id="email_id" placeholder="Email" required="required" style="width:560px" />
        </label>
        <label for="password" ><span>Create Password <span class="required">*</span></span>
          <input type="password" name="password" id="password" placeholder="Create Password" required="required" />
        </label>
        <label>
          <input type="submit" value="Add" />
        </label>
    </form>
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
