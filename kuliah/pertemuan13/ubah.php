<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'function.php';

// ambil id dari url
$id = $_GET['id'];

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

// query mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id = $id");


if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
          alert('data berhasil diubah!');
          document.location.href='index.php';
          </script>";
  } else {
    echo "data gagal diubah!";
  }
  ;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Mahasiswa</title>
</head>

<body>
  <h3>Ubah Data Mahasiswa</h3>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $m['id']; ?>">
    <ul>
      <li><label>
          Nama :
          <input type="text" name="nama" autofocus require value="<?= $m['nama']; ?>">
        </label></li>
      <li><label>
          NRP :
          <input type="text" name="nrp" require value="<?= $m['nrp']; ?>">
        </label></li>
      <li><label>
          Email :
          <input type="text" name="email" require value="<?= $m['email']; ?>">
        </label></li>
      <li><label>
          Jurusan :
          <input type="text" name="jurusan" require value="<?= $m['jurusan']; ?>">
        </label></li>
      <li><label>
          <input type="hidden" name="gambar_lama" value="<?= $m['gambar']; ?>">
          Gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>
        <img src="img/<?= $m['gambar']; ?>" width="120" style="display: block;" class="img-preview">
      </li>
      <li><button type="submit" name="ubah">Ubah Data!</button></li>
    </ul>
  </form>
  <script src="js/script.js"></script>
</body>

</html>