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

function upload()
{
  $nama = $_FILES['gambar']['name'];
  $tipe = $_FILES['gambar']['type'];
  $ukuran = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp = $_FILES['gambar']['tmp_name'];

  // cek apakah gambar sudah dipilih
  if ($error == 4) {
    echo "<script>alert('pilih gambar terlebih dahulu!')</script>";
    return false;
  }

  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $nama);
  $ekstensi_file = strtolower(end($ekstensi_file));

  // cek apakah ekstensinya ada di daftar gambar
  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>alert('ekstensi file salah!')</script>";
  }
  ;

  // cek yang diupload gambar bukan
  if ($tipe != 'image/jpeg' && $tipe != 'image/png') {
    echo "<script>alert('yang diupload bukan gambar!')</script>";
  }
  ;

  // cek ukuran gambar max = 5MB
  if ($ukuran > 5000000) {
    echo "<script>alert('ukuran gambar terlalu besar!')</script>";
  }
  ;

  // kalo udah lolos pengecekan
  $nama_baru = uniqid();
  $nama_baru .= '.';
  $nama_baru .= $ekstensi_file;

  move_uploaded_file($tmp, "img/$nama_baru");

  return $nama_baru;

}

function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  // $gambar = htmlspecialchars($data['gambar']);

  $gambar = upload();
  if (!$gambar) {
    return false;
  }
  ;

  if (empty($nama) || empty($nrp) || empty($email) || empty($jurusan)) {
    echo "<script>alert('Data harus diisi!'); 
    document.location.href= 'tambah.php';
    </script>";
    return false;
  }

  $query = "INSERT INTO
              mahasiswa 
              VALUES
              ('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);

}
;

function hapus($id)
{
  $conn = koneksi();

  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();

  $id = $data['id'];
  $nama = htmlspecialchars($data['nama']);
  $nrp = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);


  $query = "UPDATE mahasiswa SET
            nama = '$nama',
            nrp = '$nrp',
            email = '$email',
            jurusan = '$jurusan',
            gambar = '$gambar'
            WHERE id = $id";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);

}
;

function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM mahasiswa
WHERE 
nama LIKE '%$keyword%' OR
nrp LIKE '%$keyword%'";

  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  ;
  return $rows;
}
;

function masuk($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // cek username bener ga
  if ($user = query("SELECT * FROM user WHERE username = '$username' ")) {
    // cek password
    if (password_verify($password, $user['password'])) {
      $_SESSION['login'] = true;
      header("Location: index.php");
      exit;
    }

  }
  return [
    'error' => true,
    'pesan' => 'Username / Password Salah!'
  ];

}
;

function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // jika username / password kosong
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>alert('Data harus diisi!'); 
    document.location.href= 'registrasi.php';
    </script>";
    return false;
  }

  // jika username sudah terdaftar
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
    alert('Username sudah digunakan!'); 
    document.location.href= 'registrasi.php';
    </script>";
    return false;
  }
  ;

  // jika konfirmasi password tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
    alert('password tidak sesuai!'); 
    document.location.href= 'registrasi.php';
    </script>";
    return false;
  }
  ;

  // jika password < 5 digit
  if (strlen($password1) < 5) {
    echo "<script>
    alert('password terlalu pendek!'); 
    document.location.href= 'registrasi.php';
    </script>";
    return false;
  }
  ;

  // jika username & password sudah sesuai
// enkripsi password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);

  // insert ke tabel user
  $query = "INSERT INTO 
            user
            VALUES
            (null, '$username','$password_baru')";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
;