<?php 

    session_start();
    if( !isset($_SESSION['nama']) ) {
        header("Loctaion: ../login.php");
    }

    include '../connection.php';

    if( isset($_GET['pesan']) ) {
		$pesan = $_GET['pesan'];
	}

	if( isset($_GET['submit']) ) {
		$nama_supplier = htmlentities(strip_tags($_GET['nama']));

		// Filter $nama untuk mencegah sql injection
		$nama_supplier = mysqli_real_escape_string($link,$nama_supplier);

		$query = "SELECT * FROM tabel_supplier WHERE nama LIKE '%$nama_supplier%' ORDER BY kode ASC ";
		$pesan = "Hasil pencarian untuk nama barang <b>'$nama_supplier'</b>";
	}else {
		$query = "SELECT * FROM tabel_supplier ORDER BY kode ASC";
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
            <li><a href="../form_barang/logout.php">logout</a></li>
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
					<form id="search" action="tampil.php" method="GET">
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
				<h3>Data Supplier</h3>
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
								<th>Nama Supplier</th>
								<th>Jenis Kelamin</th>
								<th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Email</th>
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
									echo "<td>$data[nama]</td>";
									echo "<td>$data[jenis_kelamin]</td>";
									echo "<td>$data[alamat]</td>";
                                    echo "<td>$data[no_telepon]</td>";
                                    echo "<td>$data[email]</td>";
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