<?php
include "../config.php";

session_start();
$username = mysqli_real_escape_string($conn,$_REQUEST['email']);
$password = mysqli_real_escape_string($conn,$_REQUEST['password']);

$query = "select * from users where username='".$username."' and user_status = 1";
$result = mysqli_query($conn,$query);

if ($result->num_rows > 0) { 
	while($row = $result->fetch_assoc()) {
		if (password_verify($password, $row['password'])) {
			
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['lastname'] = $row['lastname'];
			$_SESSION['email'] = $row['username'];
			$_SESSION['user_level'] = $row['user_level'];
			$_SESSION['login_session']=1;
			
			$last_login_time = date("Y-m-d H:i:s");
			
			$query_login = "update users set user_last_login ='".$last_login_time."' where username='".$username."' and user_status = 1";
			mysqli_query($conn,$query_login);
			
			header("Location: report.php");
		}
		else {
			header("Location: login.php?invalid=1");
		}
	}
}else {
			header("Location: login.php?invalid=1");
		}

?>