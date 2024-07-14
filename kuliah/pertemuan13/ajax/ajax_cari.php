<?php
require '../function.php';
$mahasiswa = cari($_GET['keyword']);

if (empty($mahasiswa)) {
  echo "<p style='color: red; font-style:italic;'>Data tidak ditemukan!</p>";
  return exit;
}

?>

<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>#</th>
    <th>Gambar</th>
    <th>Nama</th>
    <th>Aksi</th>
  </tr>

  <?php $i = 1;
  foreach ($mahasiswa as $m): ?>
    <tr>
      <td><?= $i++; ?></td>
      <td><img src="img/<?= $m['gambar']; ?>" width="50"></td>
      <td><?= $m['nama']; ?></td>
      <td><a href="details.php?id=<?= $m['id']; ?>">Lihat Details</a></td>
    </tr>
  <?php endforeach; ?>
</table>