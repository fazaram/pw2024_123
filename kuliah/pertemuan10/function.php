<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_123123');
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);

  }



  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  ;
  return $rows;
}
;

function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);


  $query = "INSERT INTO
              mahasiswa 
              VALUES
              ('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);

}
;