<?php 


	if( isset($_GET['pesan']) ) {
		$pesan = $_GET['pesan'];
	}

	if( isset($_POST['submit']) ) {

		$username = htmlentities(strip_tags($_POST['user']));
		$password = htmlentities(strip_tags($_POST['password']));

		$pesan_error = "";

		if( empty($_POST['user']) ) {
			$pesan_error .= "Username belum diisi<br>";
		}
		if( empty($_POST['password']) ) {
			$pesan_error .= "Password belum diisi<br>";
		}

		include 'connection.php';

		// Cek apakah nama admin sesuai dengan database 
		$query = "SELECT * FROM tabel_user WHERE user='$username' AND password='$password' ";
		$result = mysqli_query($link,$query);
			if( mysqli_num_rows($result) == 0 ) {
				$pesan_error .= "Username atau password tidak sesuai";
			}
			if( $pesan_error === "" ) {
				session_start();
				$_SESSION['nama'] = $username;
				header("Location: index.php");
			}

	}else {
		$pesan_error = "";		
		$username = "";
		$password = "";
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Warehouse</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
</head>
<body>
	<div class="form_login">
		<div class="content">
			<div class="login">
				<h1>Login</h1>
			</div>
			<form action="login.php" method="POST">
				<?php 

					if( isset($pesan) ) {
						echo $pesan;
					}
					if( $pesan_error !== "" ) {
						echo $pesan_error;
					}

				?>
				<div class="user">
					<span class="glyphicon glyphicon-user"></span>
					<input class="inputGroup" type="text" name="user" id="user" placeholder="Username">
				</div>
				<div class="password">
					<span class="glyphicon glyphicon-lock"></span>
					<input class="inputGroup" type="password" name="password" id="password" placeholder="Password">	
				</div>
				<button class="btn-login" type="submit" name="submit" value="Kirim">Sign in</button>
			</form>
		</div>
	</div>
</body>
</html>