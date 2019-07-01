<?php 

	session_start();
	if( !isset( $_SESSION['nama'] ) ) {
		header("Location: ../login.php");
	}

	include '../connection.php';

	if( isset($_POST['submit']) ) {

		$kode 		   = $_POST['kode'];
		$nama_barang   = $_POST['nama_barang'];
		$nama_supplier = $_POST['nama_supplier'];
		$status_barang = $_POST['status_barang'];
		$jumlah 	   = $_POST['jumlah'];

		$query = "INSERT INTO tabel_barang VALUES 
				('$kode', '$nama_barang', '$nama_supplier', '$status_barang', $jumlah)";
		$result = mysqli_query($link,$query);
			if( $result ) {
				$pesan = "Data barang '<b>$nama_barang</b>' berhasil ditambahkan!";
				$pesan = urlencode($pesan);
				header("Location: tampil.php?pesan={$pesan}");
			}else {
				die("Query gagal dijalankan : ".mysqli_errno($link)." - ".mysqli_error($link));
			}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Warehouse</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.4.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../fontawesome-free-5.9.0-web/css/all.css">
</head>
<body>
		<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="../index.php">Sistem Informasi Warehouse</a>
        </div>      
          <ul class="nav navbar-nav navbar-right">
				<li><a href="#"><?php echo $_SESSION['nama'] ?></a></li>
            <li><a href="logout.php">logout</a></li>
          </ul>
      </div>
    </nav>
		<div id="container">
			<div class="konten">
				<h1>Sistem Informasi <span>Warehouse</span></h1>
				<div class="line"></div>
			<div class="row">
				<div class="col-md-6">
				<div class="nav-left">
					<a class="btn btn-info" href="tampil.php">Tampil</a>
					<a class="btn btn-success" href="tambah.php">Tambah</a>
					<a class="btn btn-primary" href="edit.php">Edit</a>
					<a class="btn btn-warning" href="hapus.php">Hapus</a>
					<a class="btn btn-danger" href="../get-form.php">Menu Utama</a>
				</div>
				</div>
				<div class="col-md-6">
				<div id="search">
					<form id="search" action="index.php" method="GET">
						<div class="input-group">
      						<input type="text" name="nama" id="nama" class="form-control" placeholder="Cari Barang...">
					      	<span class="input-group-btn">
					        	<button class="btn btn-primary" type="submit" name="submit">Cari!</button>
					      	</span>
					    </div>
					</form>
				</div>
				</div>
			</div>
			<h3>Tambah Barang</h3>
				<form action="tambah.php" method="POST">
					<div class="form-group">
					    <label for="kode" class="col-sm-2 control-label">Kode</label>
					    <div class="col-sm-10">
					      <input type="text" name="kode" class="form-control">
					    </div>
					</div>
					<div class="form-group">
					    <label for="nama_barang" class="col-sm-2 control-label">Nama Barang</label>
					    <div class="col-sm-10">
					      <select class="form-control" name="nama_barang">
					      	<option value="Bubble Wrapp">Bubble Wrapp</option>
					      	<option value="Pita">Pita</option>
					      	<option value="Tutup Botol">Tutup Botol</option>
					      	<option value="Botol">Botol</option>
					      </select>
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="nama_supplier" class="col-sm-2 control-label">Nama Supplier</label>
					    <div class="col-sm-10">
					      <select class="form-control" name="nama_supplier">
					      	<option value="Andi Permadi">Andi Permadi</option>
					      	<option value="Fedri Gunawan">Fedri Gunawan</option>
					      	<option value="Guntur Susanto">Guntur Susanto</option>
					      	<option value="Toni Utomo">Toni Utomo</option>
					      	<option value="Arif Hasanudin">Arif Hasanudin</option>
					      </select>
					    </div>
					</div>
					<div class="form-group">
						<label for="status_barang" class="col-sm-2 control-label">Status Barang</label>
						<div class="col-sm-10">
							<p><input type="radio" name="status_barang" value="Masuk">Masuk
								<input type="radio" name="status_barang" value="Keluar">Keluar</p>
						</div>
					</div>
					<div class="form-group">
					    <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
					    <div class="col-sm-10">
					      <input type="text" name="jumlah" class="form-control">
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" name="submit" id="submit" class="btn btn-primary">Kirim</button>
					    </div>
					</div>
				</form>
			</div>
		</div>
</body>
</html>