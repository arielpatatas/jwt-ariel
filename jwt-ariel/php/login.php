<?php
    require_once('token-create.php');
    require_once('connect.php');

    session_start();

            $user = $_POST['uname'];
	        $pass = $_POST['upass'];

	$sql = "SELECT * FROM users WHERE uname = '" . $user . "' AND upass = '" . $pass . "'";

	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);

	if($count == 1){
		$sql = "SELECT * FROM users WHERE uname = '" . $user . "'";
		$result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        // creating token 
        $id = $row['id'];
        $jwt = generateToken($id, 0, $conn);
        // end creating token


        // store token and id locally
        $_SESSION['id'] = $id;
        $_SESSION['jwt'] = $jwt;
        
        header("Location: ../validate.html");
    }
    else{
        echo "Login failed";
    }
?>