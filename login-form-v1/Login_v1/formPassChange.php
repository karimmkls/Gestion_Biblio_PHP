<?php
/*session_start();
if(isset($_SESSION["email"])){
	header("location: ../../index.php");
	exit();
}
if (isset($_POST["email"])) {
	$email = $_POST["email"];
	$pass = $_POST["pass"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($pass)) {
		$pass = md5($pass);
		$query="SELECT p.*, s.libelle, e.DATERESERVATION, e.archive
		FROM statut s
		INNER JOIN personne p ON s.id = p.id_statue
		LEFT JOIN reserverlivre e ON p.ID_PERSONNE = e.ID_PERSONNE
		WHERE  p.email LIKE :email AND p.password LIKE :pass";
		
		require("php/connection.php");
		$stmt = $con->prepare($query);
		$stmt->execute(array(":email" => $email, ":pass" => $pass));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if (!empty($data)) {

			$_SESSION["email"]=$email;
			$_SESSION["role"]=$data["libelle"];
			$_SESSION["newsletter"]=$data["newsletter"];
			$_SESSION["ID_PERSONNE"]=$data["ID_PERSONNE"];
			if(empty($data["DATERESERVATION"]) || $data["archive"] == 1){
				$_SESSION["livreReserver"]=0;
			}
			else if($data["archive"] == 0){
				$_SESSION["livreReserver"]=1;
				
			}else{
				$_SESSION["livreReserver"]=1;
			}
			// print_r($_SESSION);
			header("location: ../../index.php");
			exit();
		}
		echo "no data";
		
		header("location: formLogin.php");
		exit();
	}
} */		session_start();

	if(isset($_GET["code"])){

		$code=$_SESSION["code"];
		
		

		if($_GET["code"] ==$code ){

			
			$_SESSION["verifier"]=1;

		/*	$query="update";
                $statement=$conn->prepare($query);
                $statement->execute(array("login"=>$login,"pass"=>$pass));
                $data=$statement->fetchAll();
                if(count($data)==0){
                    echo "something is wrong";
                }
                else{
                    header('location:register.php');
                }*/
		}
		else {
			
			$_SESSION["verifier"]=0;

		}

	}
	if(isset($_POST["pass"])){
		

		if(isset($_SESSION["verifier"])){


			if($_SESSION["verifier"]==1){

				$pass=$_POST["pass"];
				$passConf=$_POST["passConf"];
				$email=$_SESSION["email"];
				$hashedPass=md5($pass);

				
				
				
				if($pass!=$passConf){
					header("location:formPassChange.php");
					exit;
				}
				require("php/connection.php");
				$query = "UPDATE personne SET PASSWORD = :password WHERE EMAIL = :email";
				$statement = $con->prepare($query);

// Bind the parameters
				$statement->bindParam(":password", $hashedPass);
				$statement->bindParam(":email", $email);

// Execute the statement and check for errors
if ($statement->execute()) {
    echo "Update successful!";
} else {
    // Display the error message
    echo "Update failed: " . $statement->errorInfo()[2];
}


				session_destroy();

				header("location:formLogin.php");
				exit;

			}


		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Member Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="#" method="post">
					<span class="login100-form-title">
						Reset Password
					</span>

					

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="New Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate="Confirm Password is required">
						<input class="input100" type="password" name="passConf" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Confirm
						</button>
					</div>

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<div class="text-center p-t-136">
						<!-- <a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a> -->
					</div>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>