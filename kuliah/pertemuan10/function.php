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
    mysqli_fetch_assoc($result);

  }


  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  ;
  return $rows;
}
;