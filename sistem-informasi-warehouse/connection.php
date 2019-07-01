<?php 

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "db_lemona";
	$link 	= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	// Cek koneksi database
		if( !$link ) {
			die("Koneksi database gagal ".mysqli_connect_errno()." - ".mysqli_connect_error());
		} 

 ?>