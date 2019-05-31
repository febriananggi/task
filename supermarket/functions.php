<?php 

$conn = mysqli_connect("localhost","root","","web_supermarket");

	function query($query) {
		global $conn;
		$result = mysqli_query($conn, $query);
		$rows = [];
		while( $row = mysqli_fetch_assoc($result) ) {
			$rows[] = $row; 
		}
		return $rows;
	}

	function tambah($data) {
		global $conn;
		$kode = $data['kode'];
		$nama = $data['nama'];
		$jenis = $data['pilihan'];
		$harga = $data['harga'];
		$jumlah = $data['jumlah'];

		// query insert data SQL
		$query = "INSERT INTO tabel_barang 
					VALUES
				('','$kode','$nama','$jenis','$harga','$jumlah')";
		
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapus($id) {
		global $conn;
		mysqli_query($conn, "DELETE FROM tabel_barang WHERE id = $id");
		return mysqli_affected_rows($conn);
	}

	function ubah($data) {
		global $conn;

		$id = $data['id'];
		$kode = $data['kode'];
		$nama = $data['nama'];
		$jenis = $data['pilihan'];
		$harga = $data['harga'];
		$jumlah = $data['jumlah'];

		// query insert data SQL
		$query = "UPDATE tabel_barang SET
					kode = $kode,
					nama_barang = '$nama',
					jenis = '$jenis',
					harga = $harga,
					jumlah = $jumlah 
					WHERE id = $id";
		
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

?>