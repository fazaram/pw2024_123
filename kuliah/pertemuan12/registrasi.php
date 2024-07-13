<?php
session_start();

if (!isset($_SESSION['login'])) {
  header('Location: login.php');
}

require 'function.php';

if (isset($_POST['regist'])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
    alert('Berhasil terdaftar!'); 
    document.location.href= 'login.php';
    </script>";
  } else {
    echo "<script>alert('Gagal daftar!');</script>";
  }
  ;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Registrasi</title>
  <a href="login.php">Kembali ke login</a>
</head>

<body>
  <h3>Form Registrasi</h3>
  <form action="" method="POST">
    <ul>
      <li><label>
          Username :
          <input type="text" name="username" autofocus autocomplete="off" required>
        </label></li>
      <li>
        <label>
          Password :
          <input type="password" name="password1" required>
        </label>
      </li>
      <li><label>
          Re-enter Password :
          <input type="password" name="password2" required>
        </label></li>
      <li><button type="submit" name="regist">Registrasi</button></li>
    </ul>
  </form>
</body>

</html>