<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'function.php';

// ambil id dari URL

$id = $_GET['id'];

// query  mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>

  <ul>
    <li><img src="img/<?= $m['gambar']; ?>" width="150"></li>
    <li><?= $m['nrp']; ?></li>
    <li><?= $m['nama']; ?></li>
    <li><?= $m['email']; ?></li>
    <li><?= $m['jurusan']; ?></li>
    <li><a href="ubah.php?id=<?= $m['id']; ?>"> ubah </a> | <a href="hapus.php?id=<?= $m['id']; ?>"
        onclick="return confirm('apakah anda yakin?');">
        hapus
      </a></li>
    <li><a href="index.php"> Kembali ke daftar mahasiswa </a></li>
  </ul>

</body>

</html>