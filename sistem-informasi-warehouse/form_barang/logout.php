<?php 

	session_start();
	// Hapus session
	unset($_SESSION['nama']);

	// Redirect ke halaman login
	header("Location: ../login.php");

 ?>