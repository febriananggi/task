<?php 
	
	session_start();
	if( !isset( $_SESSION['nama'] ) ) {
		header("Location: ../login.php");
	}
	
	include '../connection.php';

	if( isset($_POST['submit']) ) {

		$kode = htmlentities(strip_tags($_POST['kode']));
		// Filter data
		$kode = mysqli_real_escape_string($link,$kode);
		
		$query = "DELETE FROM tabel_barang WHERE kode='$kode'";
		$result = mysqli_query($link,$query);
			if( $result ) {
				$pesan = "Kode barang <b>$kode</b> berhasil dihapus";
				$pesan = urlencode($pesan);
				header("Location: index.php?pesan={$pesan}");
			}else {
				die("Query Error : ".mysqli_errno($link)." - ".mysqli_error($link));
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
				<h3>Hapus Barang</h3>
				<?php 

					if( isset($GET['pesan']) ) {
						echo "<div class='pesan'>'{$_GET['pesan']}'</div>";
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
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 

								$query = "SELECT * FROM tabel_barang ORDER BY kode ASC";
								$result = mysqli_query($link,$query);
									if( !$result ) {
										die("Query Error : ".mysqli_errno($link)." - ".msql_error($link));
									}

								while( $data = mysqli_fetch_assoc($result) ) {
									echo "<tr>";
									echo "<td>$data[kode]</td>";
									echo "<td>$data[nama_barang]</td>";
									echo "<td>$data[nama_supplier]</td>";
									echo "<td>$data[status]</td>";
									echo "<td>$data[jumlah]</td>";
									echo "<td>";
								?>
									<form action="hapus.php" method="POST">
										<input type="hidden" name="kode" value="<?php echo "$data[kode]"; ?>">
										<button class="btn btn-warning btn-sm" type="submit" name="submit" value="hapus">HAPUS</button>
									</form>
								<?php 

									echo "</td>";
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