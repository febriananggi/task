<?php require 'functions.php';

	// mengambil data dari database
	$barang = query("SELECT * FROM tabel_barang");
	if( !$barang ) {
		echo mysqli_error($conn);
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Barang</title>
	<link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
	<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div id="wrapper">
			<div class="content">
				<h1>Data Barang</h1>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Nama Barang</th>
							<th>Jenis</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($barang as $row) : ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row["kode"]; ?></td>
							<td><?php echo $row["nama_barang"]; ?></td>
							<td><?php echo $row["jenis"]; ?></td>
							<td><?php echo $row["harga"]; ?></td>
							<td><?php echo $row["jumlah"]; ?></td>
							<td>
								<a href="ubah.php?id=<?php echo $row['id'] ?>" id="ubah">Ubah</a>
								<a href="hapus.php?id=<?php echo $row['id'] ?>" id="hapus">Hapus</a>
							</td>
						</tr>
						<?php $i++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="form_barang.php"><<< Kembali</a>
			</div>
		</div>
	</div>
</body>
</html>