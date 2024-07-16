<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
require 'function.php';



if (isset($_POST['tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
          alert('data berhasil ditambahkan!');
          document.location.href='index.php';
          </script>";
  }
  ;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Mahasiswa</title>
</head>

<body>
  <a href="index.php">Kembali</a>
  <h3>Tambah Data Mahasiswa</h3>
  <form action="" method="post" enctype="multipart/form-data">
    <ul>
      <li><label>
          Nama :
          <input type="text" name="nama" autofocus required>
        </label></li>
      <li><label>
          NRP :
          <input type="text" name="nrp" required>
        </label></li>
      <li><label>
          Email :
          <input type="text" name="email" required>
        </label></li>
      <li><label>
          Jurusan :
          <input type="text" name="jurusan" required>
        </label></li>
      <li><label>
          Gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label></li>
      <br>
      <img src="img/nofoto.png" width="50" style="display: block;" class="img-preview">
      <br>
      <li><button type="submit" name="tambah">Tambah Data!</button></li>
    </ul>
  </form>
  <script src="js/script.js"></script>
</body>

</html>