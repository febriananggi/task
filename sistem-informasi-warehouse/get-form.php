<?php 

    session_start();
    if( !isset($_SESSION['nama']) ) {
        header("Location: login.php");
    }

    if( isset($_POST['form_barang']) ) {
        header("Location: form_barang/tampil.php");
    }
    if( isset($_POST['form_supplier']) ) {
        header("Location: form_supplier/tampil.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Selection</title>
    <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-3.4.1-dist/js/bootstrap.min.js">
    <link rel="stylesheet" href="index.css">
</head>
<body>
<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Sistem Informasi Warehouse</a>
        </div>      
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $_SESSION['nama'] ?></a></li>
            <li><a href="form_barang/logout.php">logout</a></li>
          </ul>
      </div>
    </nav>
    <div class="contanier selection">
        <div class="container-selection">
            <form action="" method="POST">
                <button class="formGroup" name="form_barang">Form Barang</button>
                <button class="formGroup" name="form_supplier">Form Supplier</button>
            </form>
        </div>
    </div>
</body>
</html>