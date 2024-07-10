<?php

require 'function.php';

// ambil id dari URL

$id = $_GET['id'];

// query  mahasiswa berdasarkan id
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id = $id")

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
  <?php foreach ($mahasiswa as $m): ?>
    <ul>
      <li><img src="img/<?= $m['gambar']; ?>" width="50"></li>
      <li><?= $m['nrp']; ?></li>
      <li><?= $m['nama']; ?></li>
      <li><?= $m['email']; ?></li>
      <li><?= $m['jurusan']; ?></li>
      <li><a href=""> ubah </a> | <a href=""> hapus </a></li>
      <li><a href="latihan3.php"> Kembali ke daftar mahasiswa </a></li>
    </ul>
  <?php endforeach; ?>
</body>

</html>