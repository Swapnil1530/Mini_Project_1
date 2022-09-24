<?php
session_start();
include "./Connection/connection_test.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="./index.css">
	<title>SPCE</title>
</head>

<body>
	<div class="header">
		<h1>SPCE</h1>

	</div>
	<div class="wrapper">
		<div class="form_container">
			<form action="index.php" method="POST">
				<div class="heading">
					<h2>Login</h2>
				</div>
				<?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
				<?php } ?>

				<div class="form_wrap">
					<div class="form_item">
						<label>Email </label>
						<input type="text" class="input-box" name="Name">

					</div>
				</div>
				<div class="form_wrap">
					<div class="form_item">
						<label>Password</label>
						<input type="password" class="input-box" name="Password">

					</div>
				</div>


				<div class="btn">
					<button type="submit" class="button" name="login">Login</button>

				</div>
			</form>
		</div>
	</div>


</body>
<?php
if (isset($_POST['Name']) && isset($_POST['Password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}
$name = validate($_POST['Name']);
$pass = validate($_POST['Password']);

if (empty($name)) {
	header("Location:index.php?error=User Name is required");
	exit();
} else if (empty($pass)) {
	header("Location:index.php?error=Password is required");
	exit();
}
$sql = "SELECT * FROM student_login WHERE Student_name='$name' AND Student_password='$pass'";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_assoc($result);
	if ($row['Student_name'] === $name && $row['Student_password'] === $pass) {
		echo "login successful";
		header("Location:/Syllabus/syllabus.html");
		exit();
	} else {
		header("Location:index.php?error=Incorrect User name or Password");
		exit();
	}
} else {
	header("Location:index.php");
	exit();
}
?>


</html>
