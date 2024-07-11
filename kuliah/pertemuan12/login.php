<?php

session_start();

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require 'function.php';

if (isset($_POST["masuk"])) {
  $login = masuk($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
</head>

<body>
  <h3>Form Login</h3>

  <?php if (isset($login['error'])): ?>
    <p style="color: red; font-style:italic"><?= $login['pesan']; ?></p>
  <?php endif; ?>

  <form action="" method="POST">
    <ul>
      <li>
        <label>
          Username :
          <input type="text" name="username" required autocomplete="off" autofocus>
        </label>
      </li>
      <li> <label>
          Password :
          <input type="password" name="password" required>
        </label></li>
      <li><button type="submit" name="masuk">Login!</button></li>
    </ul>


  </form>
</body>

</html>