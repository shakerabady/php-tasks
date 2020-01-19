<?php
if(isset($_POST)){
	// to check if the form has been submitted or not!
	

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'] ;
$password = $_POST['password'] ;
$password_confirmation = $_POST['password_confirmation'];
if(!empty($first_name) || !empty($last_name) || !empty($email) || !empty($password) || !empty($password_confirmation)){
	if ($password === $password_confirmation){
		$host ='localhost';
		$dbusername ='root';
		$psw ='';
		$dbname ='signup';

		// create connection 

		$conn = new mysqli($host,$dbusername,$psw,$dbname);

		if (mysqli_connect_error()){
			die('Connect_error('.mysqli_connect_errno().')'.mysqli_connect_error());
		} else {
			$SELECT = "SELECT email From users where email =? limit 1";
			$INSERT = "INSERT Into users (first_name, last_name, email, password) values (?,?,?,?)";

			// prepare statement

			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param('s',$emai);
			$stmt->execute();
			$stmt->bind_result($email);
			$stmt->store_result();
			$rnum = $stmt->num_rows();

			if($rnum == 0) {
				$stmt->close();

				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("ssss",$first_name, $last_name, $email, $password);
				$stmt->execute();
				echo "new records inserted successfully";
			} else {
				echo "someone is already registered with this email address";
			}
			$stmt->close();
			$conn->close();
		}
	}
}
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogIn</title>
</head>
<body>
    <h1>you have successfully registered with us </h1>
    <h1>your first name is <?php echo($first_name)?> </h1>
    
</body>
</html>