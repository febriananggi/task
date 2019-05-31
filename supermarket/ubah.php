<?php require 'functions.php';

// Ambil data di URL
	$id = $_GET['id'];

// Query data berdasarkan id
	$data = query("SELECT * FROM tabel_barang WHERE id = $id")[0];
	var_dump($data['jenis']); 

	$conn = mysqli_connect("localhost","root","","web_supermarket");
	if( isset($_POST["submit"]) ) {

		if( ubah($_POST) > 0 ) {
			echo 	'<script>
						alert("Data Berhasil disimpan");
						document.location.href = "data_barang.php";
					</script>';
		}else {
			echo 	'<script>
						alert("Data Gagal disimpan!");
						document.location.href = "data_barang.php";
					</script>';
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Update Barang</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container-fluid">
		<div id="wrapper" class="wrapper">
			<div class="content">
				<h1>Form Update Barang</h1>
				<form action="" method="POST" class="form-horizontal">
					<input type="hidden" name="id" value="<?php echo $data['id'] ?>" >
					<div class="form-group">
					    <label for="kode" class="col-sm-2 control-label">Kode</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $data['kode'] ?>" >
					    </div>
					 </div>
					 <div class="form-group">
					    <label for="nama" class="col-sm-2 control-label">Nama Barang</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_barang'] ?>" >
					    </div>
					 </div>
					 <div class="form-group">
					    <label for="jenis" class="col-sm-2 control-label">Jenis</label>
					    <div class="col-sm-10">
					    <select class="form-control" name="pilihan" id="jenis" >
							<option>-Pilihan-</option>
							<option <?php if($data['jenis'] == 'Makanan') echo 'selected' ?> value="Makanan" >Makanan</option>
							<option <?php if ($data['jenis'] == 'Minuman') echo 'selected' ?> value="Minuman" >Minuman</option>
						</select>
					    </div>
					 </div>
					 <div class="form-group">
					    <label for="harga" class="col-sm-2 control-label">Harga</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="harga" id="harga" value="<?php echo $data['harga'] ?>" >
					    </div>
					 </div>
					 <div class="form-group">
					    <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="jumlah" id="jumlah" value="<?php echo $data['jumlah'] ?>" >
					    </div>
					 </div>
					 <div class="form-group">
					    <div class="col-sm-offset-10 col-sm-2">
					    	<button type="submit" name="submit" class="btn btn-primary">KIRIM</button>
					    </div>
					 </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>