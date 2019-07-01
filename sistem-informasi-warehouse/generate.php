<?php 

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$link   = mysqli_connect($dbhost,$dbuser,$dbpass);

	// Buat database jika belum ada
	$query = "CREATE DATABASE IF NOT EXISTS warehouse";
	$result = mysqli_query($link,$query);
		if( !$result ) {
			die("Query Error : ".mysqli_errno($link)." - ".mysqli_error($link));
		}else {
			echo "Database Warehouse berhasil dibuat...<br>";
		}

	$result = mysqli_select_db($link, "warehouse");
		if( !$result ) {
			die("Query Error : ".mysqli_errno($link)." - ".mysqli_error($link));
		}else {
			echo "Database Warehouse telah dipilih...<br>";
		}

	// Cek apakah tabel barang sudah ada. jika ada hapus	
	$query = "DROP TABLE IF EXISTS barang";
	$result = mysqli_query($link,$query);
		if( !$result ) {
			die("Query Error : ".mysqli_errno($link)." - ".mysqli_error($link));
		}else {
			echo "Tabel Barang berhasil dihapus...<br>";
		}

	// Membuat tabel barang
	$query = "CREATE TABLE barang (kode char(5), nama_barang varchar(20), nama_supplier 			varchar(50), jumlah_barang int(20), PRIMARY KEY (kode))"; 
	$result = mysqli_query($link,$query);
		if( !$result ) {
			die("Query Error : ".mysqli_errno($link)." - ".mysqli_error($link));
		}else {
			echo "Tabel Barang berhasil dibuat...<br>";
		}

	// Insert data tabel barang
	$query = "INSERT INTO barang VALUES 
				(1, 'Bubble Wrapp', 'Andi Permana', 2),
				(2, 'Pita', 'Toni Andriana', 3) ";
	$result = mysqli_query($link,$query);
		if( !$result ) {
			die("Query Error : ".mysqli_errno($link)." - ".mysqli_error($link));
		}else {
			echo "Tabel Barang berhasil ditambahkan...<br>";
		}


 ?>