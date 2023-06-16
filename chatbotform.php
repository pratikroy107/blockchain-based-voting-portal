<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$problem = $_POST['problem'];

	// Database connection
	$conn = new mysqli('localhost','root','','vote');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} 
	else {
		$sql1 = "SELECT * FROM chatbot where Email='$email' and Phone='$phone'";
		$result = $conn->query($sql1);
		if ($result->num_rows > 0)
		{
			echo "Sorry, you cannot send multiple messages with same email and phone.";
		}
		else
		{
			$stmt = $conn->prepare("insert into chatbot(name, email, phone, problem) values(?, ?, ?, ?)");
			$stmt->bind_param("ssis", $name, $email, $phone, $problem);
			$execval = $stmt->execute();
			//echo $execval;
			echo '<script type="text/Javascript">
			alert("Message has been sent. We will contact you back soon!");
			</script>';
			$stmt->close();
		}
		$conn->close();
	}
?>