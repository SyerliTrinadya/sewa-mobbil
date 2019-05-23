<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Karyawan</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/moment.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/bootstrap-datepicker.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-info navbar-dark sticky-top">
    <a href="#" class="text-white">
        <h3>SEWA MOBIL</h3>
        <h5 class="text-white">Hello, <?php echo $_SESSION["username"]; ?></h5>
    </a>
    
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
        <span class="navbar navabr-toggle-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu"></div>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="template.php?page=pelanggan" class="nav-link">Pelanggan</a></li>
            <li class="nav-item"><a href="template.php?page=mobil" class="nav-link">Mobil</a></li>
            <li class="nav-item"><a href="template.php?page=karyawan" class="nav-link">Karyawan</a></li>
            <li class="nav-item"><a href="template.php?page=peminjaman" class="nav-link">Peminjaman</a></li>
            <li class="nav-item"><a href="template.php?page=pengembalian" class="nav-link">Pengembalian</a></li>
            <li class="nav-item"><a href="template.php?page=laporan" class="nav-link">Laporan</a></li>
            <li class="nav-item"><a href="logout.php?logout=true" class="nav-link">Logout</a></li>
        </ul>
    </div>
     
    </nav>
    <div class="container my-2">
  <?php if (isset($_GET["page"])): ?>
    <?php if ((@include $_GET["page"].".php") === true): ?>
      <?php include $_GET["page"].".php"; ?>
    <?php endif; ?>
  <?php endif; ?>
</div>
</body>
</html>