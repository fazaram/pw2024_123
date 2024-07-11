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
  } else {
    echo "data gagal ditambah!";
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
  <h3>Tambah Data Mahasiswa</h3>
  <form action="" method="post">
    <ul>
      <li><label>
          Nama :
          <input type="text" name="nama" autofocus require>
        </label></li>
      <li><label>
          NRP :
          <input type="text" name="nrp" require>
        </label></li>
      <li><label>
          Email :
          <input type="text" name="email" require>
        </label></li>
      <li><label>
          Jurusan :
          <input type="text" name="jurusan" require>
        </label></li>
      <li><label>
          Gambar :
          <input type="text" name="gambar" required>
        </label></li>
      <li><button type="submit" name="tambah">Tambah Data!</button></li>
    </ul>
  </form>
</body>

</html>