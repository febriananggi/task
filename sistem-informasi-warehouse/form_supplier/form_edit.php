<?php 

    session_start();
    if( !isset($_SESSION['nama']) ) {
        header("Location: ../login.php");
    }

    include '../connection.php';

    if( isset($_POST['submit']) ) {

        if( $_POST['submit'] == "edit" ) {

            $kode = htmlentities(strip_tags($_POST['kode']));

            $query = "SELECT * FROM tabel_supplier WHERE kode = '$kode' ";
            $result = mysqli_query($link,$query);
                if( !$result ) {
                    die("Query Error : ".mysqli_errno($link)." - ".mysqli_error($link));
                }

            $data = mysqli_fetch_assoc($result);

            $kode          = $data['kode'];
            $nama_supplier = $data['nama'];
            $jenis_kelamin = $data['jenis_kelamin'];
            $alamat        = $data['alamat'];
            $no_telepon    = $data['no_telepon'];
            $email         = $data['email'];
        }

        if( $_POST['submit'] == 'update' ) {

            $kode            = htmlentities(strip_tags($_POST['kode']));
            $nama_supplier   = htmlentities(strip_tags($_POST['nama_supplier']));
            $jenis_kelamin   = htmlentities(strip_tags($_POST['jekel']));
            $alamat          = htmlentities(strip_tags($_POST['alamat']));
            $no_telepon      = htmlentities(strip_tags($_POST['notelp']));
            $email           = htmlentities(strip_tags($_POST['email']));

            $query = "UPDATE tabel_supplier SET ";
            $query .= "nama = '$nama_supplier', jenis_kelamin = '$jenis_kelamin',";
            $query .= "alamat = '$alamat', no_telepon = '$no_telepon', email = '$email' ";
            $query .= "WHERE kode = '$kode' ";
            $result = mysqli_query($link,$query);
                if( $result ) {
                    $pesan = "Data supplier dengan kode '<b>$kode</b>' berhasil di update";
                    $pesan = urlencode($pesan);
                    header("Location: tampil.php?pesan={$pesan}");
                }else {
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
			<h3>Edit Data Supplier</h3>
            <h4>"Kode supplier tidak bisa di edit"</h4>
				<form action="form_edit.php" method="POST">
					<div class="form-group">
					    <label for="kode" class="col-sm-2 control-label">Kode</label>
					    <div class="col-sm-10">
					      <input type="text" value="<?php echo $kode ?>" name="kode" class="form-control">
					    </div>
					</div>
				    <div class="form-group">
					    <label for="nama_supplier" class="col-sm-2 control-label">Nama Supplier</label>
					    <div class="col-sm-10">
					      <select class="form-control" name="nama_supplier">
					      	<option value="Andi Permadi" <?php if( $nama_supplier == 'Andi Permadi' ) echo 'selected' ?>>Andi Permadi</option>
					      	<option value="Fedri Gunawan" <?php if( $nama_supplier == 'Fedri Gunawan' ) echo 'selected' ?>>Fedri Gunawan</option>
					      	<option value="Guntur Susanto" <?php if( $nama_supplier == 'Guntur Susanto' ) echo 'selected' ?>>Guntur Susanto</option>
					      	<option value="Toni Utomo" <?php if( $nama_supplier == 'Toni Utomo' ) echo 'selected' ?>>Toni Utomo</option>
					      	<option value="Arif Hasanudin" <?php if( $nama_supplier == 'Arif Hasanudin' ) echo 'selected' ?>>Arif Hasanudin</option>
					      </select>
					    </div>
					</div>
					<div class="form-group">
						<label for="jekel" class="col-sm-2 control-label">Jenis Kelamin</label>
						<div class="col-sm-10">
							<p><input <?php if( $jenis_kelamin == 'Laki - Laki' ) echo 'checked' ?> type="radio" name="jekel" value="Laki - Laki"><span class="radio-btn">Laki-Laki</span>
							    <input <?php if( $jenis_kelamin == 'Perempuan' ) echo 'checked' ?> type="radio" name="jekel" value="Perempuan"><span class="radio-btn">Perempuan</span></p>
						</div>
					</div>
					<div class="form-group">
					    <label for="alamat" class="col-sm-2 control-label">Alamat</label>
					    <div class="col-sm-10">
					      <textarea rows="3" name="alamat" class="form-control"><?php echo $alamat ?></textarea>
					    </div>
                    </div>
                    <div class="form-group">
					    <label for="notelp" class="col-sm-2 control-label">No Telepon</label>
					    <div class="col-sm-10">
					      <input type="text" name="notelp" value="<?php echo $no_telepon ?>" class="form-control">
					    </div>
                    </div>
                    <div class="form-group">
					    <label for="email" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-10">
					      <input type="text" name="email" value="<?php echo $email ?>" class="form-control">
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" value="update" name="submit" id="submit" class="btn btn-primary">Kirim</button>
					    </div>
					</div>
				</form>
			</div>
		</div>
</body>
</html>