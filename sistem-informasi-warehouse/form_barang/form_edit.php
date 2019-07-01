<?php 

	session_start();
	if( !isset($_SESSION['nama']) ) {
		header("Location: login.php");
	}

	include '../connection.php';

	if( isset($_POST['submit']) ) {

    if( $_POST['submit'] == "edit" ) {

        $kode = $_POST['kode'];

        $query = "SELECT * FROM tabel_barang WHERE kode='$kode'";
        $result = mysqli_query($link,$query);
            if( !$result ) {
                die("Query gagal dijalankan ".mysqli_errno($link)." - ".mysqli_error($link));
            }
        
        // Tidak perlu memakai perulangan karena hanya 1 record
        $data = mysqli_fetch_assoc($result);

        $kode 				 = $data['kode'];
        $nama_barang   = $data['nama_barang'];
        $nama_supplier = $data['nama_supplier'];
        $status_barang = $data['status'];
        $jumlah 			 = $data['jumlah'];
			}
				
			if ( $_POST['submit'] == 'update' ) {

						$query = "UPDATE tabel_barang SET";
						$query .= "nama_barang = '$nama_barang', nama_supplier = '$nama_supplier', ";
						$query .= "status = '$status_barang', jumlah = $jumlah ";
						$query .= "WHERE kode = '$kode' ";
            $result = mysqli_query($link,$query);
            if( $result ) {
                    $pesan = "Data barang dengan '<b>$kode</b>' berhasil diupdate!";
                    $pesan = urldecode($pesan);
                    header("Location: tampil.php?pesan={$pesan}");
                }else {
					// die("Query gagal dijalankan ".mysqli_errno($link)." - ".mysqli_error($link));
					echo "<script>
							alert('Kode barang tidak bisa di edit!');
							document.location.href = 'edit.php';
						</script>";
            }

        }
		}else {
        header("Location: edit.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
			<h3>Update Barang</h3>
			<h4>"Kode barang tidak bisa di edit"</h4>
				<form action="form_edit.php" method="POST">
					<div class="form-group">
					    <label for="kode" class="col-sm-2 control-label">Kode</label>
					    <div class="col-sm-10">
					      <input type="text" name="kode" class="form-control" value="<?php echo $kode ?>">
					    </div>
					</div>
					<div class="form-group">
					    <label for="nama_barang" class="col-sm-2 control-label">Nama Barang</label>
					    <div class="col-sm-10">
					      <select class="form-control" name="nama_barang">
					      	<option <?php if($nama_barang == 'Bubble Wrapp') echo 'selected' ?> value="Bubble Wrapp">Bubble Wrapp</option>
					      	<option <?php if($nama_barang == 'Pita') echo 'selected' ?> value="Pita">Pita</option>
					      	<option <?php if($nama_barang == 'Tutup Botol') echo 'selected' ?> value="Tutup Botol">Tutup Botol</option>
					      	<option <?php if($nama_barang == 'Botol') echo 'selected' ?> value="Botol">Botol</option>
									<option <?php if($nama_barang == 'Sticker') echo 'selected' ?> value="Stricker">Sticker</option>
									<option <?php if($nama_barang == 'Dus Master') echo 'selected' ?> value="Dus Master">Dus Master</option>
									<option <?php if($nama_barang == 'Label') echo 'selected' ?> value="Label">Label</option>
					      </select>
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="nama_supplier" class="col-sm-2 control-label">Nama Supplier</label>
					    <div class="col-sm-10">
					      <select class="form-control" name="nama_supplier">
					      	<option <?php if($nama_supplier == 'Andi Permadi') echo 'selected' ?> value="Andi Permadi">Andi Permadi</option>
					      	<option <?php if($nama_supplier == 'Fedri Gunawan') echo 'selected' ?> value="Fedri Gunawan">Fedri Gunawan</option>
					      	<option <?php if($nama_supplier == 'Guntur Susanto') echo 'selected' ?> value="Guntur Susanto">Guntur Susanto</option>
					      	<option <?php if($nama_supplier == 'Toni Utomo') echo 'selected' ?> value="Toni Utomo">Toni Utomo</option>
					      	<option <?php if($nama_supplier == 'Arif Hasanudin') echo 'selected' ?> value="Arif Hasanudin">Arif Hasanudin</option>
					      </select>
					    </div>
					</div>
					<div class="form-group">
						<label for="status_barang" class="col-sm-2 control-label">Status Barang</label>
						<div class="col-sm-10">
							<p><input type="radio" name="status_barang" <?php if($status_barang == 'Masuk') echo 'checked' ?> value="Masuk">Masuk
								<input type="radio" name="status_barang" <?php if($status_barang == 'Keluar') echo 'checked' ?> value="Keluar">Keluar</p>
						</div>
					</div>
					<div class="form-group">
					    <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
					    <div class="col-sm-10">
					      <input type="text" name="jumlah" value="<?php echo $jumlah ?>" class="form-control">
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" id="submit" class="btn btn-primary" value="update">Kirim</button>
					    </div>
					</div>
				</form>
			</div>
		</div>
</body>
</html>