<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title"><i class="fa fa-edit"></i> Tambah Data</h3>
  </div>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card-body">

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama User</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" placeholder="Nama user" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Level</label>
        <div class="col-sm-4">
          <select name="level" id="level" class="form-control">
            <option>- Pilih -</option>
            <option>Administrator</option>
            <option>karyawan</option>
          </select>
        </div>
      </div>

    </div>
    <div class="card-footer">
      <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
      <a href="?page=MyApp/data_pengguna" title="Kembali" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>

<?php

if (isset($_POST['Simpan'])) {
  //mulai proses simpan data
  $username = mysqli_real_escape_string($koneksi, $_POST['username']);
  $password = mysqli_real_escape_string($koneksi, $_POST['password']);

  //hash
  $hashed_password = md5($password);
  $sql_simpan = "INSERT INTO tb_pengguna (nama_pengguna,username,password,level) VALUES (
        '" . $_POST['nama_pengguna'] . "',
        '" . $_POST['username'] . "',
        '" . $hashed_password . "',
        '" . $_POST['level'] . "')";
  $query_simpan = mysqli_query($koneksi, $sql_simpan);
  mysqli_close($koneksi);


  if ($query_simpan) {
    echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=MyApp/data_pengguna';
          }
      })</script>";
  } else {
    echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=MyApp/add_pengguna';
          }
      })</script>";
  }
}

// // register
// if (isset($_POST['Simpan'])) {
//   //anti inject sql
//   $username = mysqli_real_escape_string($koneksi, $_POST['username']);
//   $password = mysqli_real_escape_string($koneksi, $_POST['password']);
//   $nama_pengguna = mysqli_real_escape_string($koneksi, $_POST['nama_pengguna']);
//   $level = mysqli_real_escape_string($koneksi, $_POST['level']);


//   //enkripsi password
//   $password_md5 = md5($password);

//   //query register
//   $sql_register = "INSERT INTO tb_pengguna (nama_pengguna,username,password,level) VALUES (
//           " . $_POST['nama_pengguna'] . "',
//           '" . $_POST['username'] . "',
//           '" . $password_md5 . "',
//           '" . $_POST['level'] . "')";
//   $query_register = mysqli_query($koneksi, $sql_register);

//   if ($query_register) {
//     echo "<script>
// 	  Swal.fire({title: 'Register Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
// 	  }).then((result) => {if (result.value)
// 		{window.location = 'login';}
// 	  })</script>";
//   } else {
//     echo "<script>
// 	  Swal.fire({title: 'Register Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
// 	  }).then((result) => {if (result.value)
// 		{window.location = 'register';}
// 	  })</script>";
//   }
// }
// //selesai proses simpan data
// 
?>