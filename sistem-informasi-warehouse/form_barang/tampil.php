<?php 
	
	session_start();
	if( !isset( $_SESSION['nama'] ) ) {
		header("Location: ../login.php");
	}
	
	include '../connection.php';

	if( isset($_GET['pesan']) ) {
		$pesan = $_GET['pesan'];
	}

	if( isset($_GET['submit']) ) {
		// Ambil nilai nama barang
		$nama_barang = htmlentities(strip_tags($_GET['nama']));

		// Filter $nama untuk mencegah sql injection
		$nama_barang = mysqli_real_escape_string($link,$nama_barang);

		$query = "SELECT * FROM tabel_barang WHERE nama_barang LIKE '%$nama_barang%' ORDER BY kode ASC ";
		// buat pesan
		$pesan = "Hasil pencarian untuk nama barang <b>'$nama_barang'</b>";
	}else {
		$query = "SELECT * FROM tabel_barang ORDER BY kode ASC";
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
      						<input type="text" name="nama" id="nama" class="form-control" placeholder="Cari Supplier...">
					      	<span class="input-group-btn">
					        	<button class="btn btn-primary" type="submit" name="submit">Cari!</button>
					      	</span>
					    </div>
					</form>
				</div>
				</div>
			</div>
				<h3>Data Barang</h3>
				<?php 
					
					// Tampilkan pesan jika ada
					if( isset($pesan) ) {
						echo "<div class='pesan'>$pesan</div>";
					}

				 ?>
				<div class="tampil-tabel">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Kode</th>
								<th>Nama Barang</th>
								<th>Nama Supplier</th>
								<th>Status Barang</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php 

								$result = mysqli_query($link,$query);
									if( !$result ) {
										die("Query Error : ".mysqli_errno($link)." - ".mysqli_error($link));
									}

								while( $data = mysqli_fetch_assoc($result) ) {
									echo "<tr>";
									echo "<td>$data[kode]</td>";
									echo "<td>$data[nama_barang]</td>";
									echo "<td>$data[nama_supplier]</td>";
									echo "<td>$data[status]</td>";
									echo "<td>$data[jumlah]</td>";
									echo "</tr>";
								}

							?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	
</body>
</html>
