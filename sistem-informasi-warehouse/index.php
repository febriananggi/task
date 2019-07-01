<?php 

	session_start();
	if( !isset( $_SESSION['nama'] ) ) {
		header("Location: login.php");
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Warehouse</title>
  <link rel="stylesheet" type="text/css" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap-3.4.1-dist/js/bootstrap.min.js">
  <!-- <link rel="stylesheet" type="text/css" href="jquery.js"> -->
  <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Sistem Informasi Warehouse</a>
        </div>      
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $_SESSION['nama'] ?></a></li>
            <li><a href="form_barang/logout.php">logout</a></li>
          </ul>
      </div>
    </nav>
    <div class="form">
      <div class="form-content">
        <h1>Selamat Datang, <?php echo $_SESSION['nama']; ?></h1>
        <a href="get-form.php">
          <div class="get-form"><h3>Get Started</h3></div>
        </a>
      </div>
    </div>
</body>
</html>