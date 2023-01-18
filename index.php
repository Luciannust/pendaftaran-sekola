<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "daftarsekola2";

$koneksi    = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
  die("gagal");
}
$nik              = "";
$nama             = "";
$jeniskelamin     = "";
$alamat           = "";
$asal             = "";
$nomor            = "";
$sukses           = "";
$error            = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
}else{
  $op = "";
}
if($op == 'delete') {
  $id     = $_GET['id'];
  $sql1   = "delete from data where id = '$id'";
  $q1     = mysqli_query($koneksi,$sql1);

  if($q1){
    $sukses = "Berhasil hapus data";
  }else{
    $error  = "Gagal melakukan delete data";
  }
}
if($op == 'edit'){
  $id             = $_GET['id'];
  $sql1           = "select * from data where id = '$id'";
  $q1             = mysqli_query($koneksi,$sql1);
  $r1             = mysqli_fetch_array($q1);
  $nik            = $r1['nik'];
  $nama           = $r1['nama'];
  $jeniskelamin   = $r1['jeniskelamin'];
  $alamat         = $r1['alamat'];
  $asal           = $r1['asal'];
  $nomor          = $r1['nomor'];

  if($nik == ''){
    $error = "Data tidak ditemukan";
  }
}
if(isset($_POST['simpan'])){  //untuk create
  $nik      = $_POST['nik'];
  $nama     = $_POST['nama'];
  $jeniskelamin = $_POST['jeniskelamin'];
  $alamat       = $_POST['alamat'];
  $asal         = $_POST['asal'];
  $nomor        = $_POST['nomor'];

  if($nik && $nama && $jeniskelamin && $alamat && $asal && $nomor){
    if($op == 'edit'){ //untuk update
      $sql1       = "update data set nik = '$nik',nama='$nama',jeniskelamin='$jeniskelamin',alamat='$alamat',asal='$asal',nomor='$nomor' where id = '$id'";
      $q1         = mysqli_query($koneksi,$sql1);
      if($q1){
        $sukses   = "Data behasil diupdate";
      }else{
        $error    = "Data gagal diupdate";
      }
    }else{ //untuk insert
      $sql1 = "insert into data (nik,nama,jeniskelamin,alamat,asal,nomor) values ('$nik','$nama','$jeniskelamin','$alamat','$asal','$nomor')";
    $q1   = mysqli_query($koneksi,$sql1);
    if($q1){
      $sukses     = "Berhasil memasukan data baru";
    }else{
      $error      = "Gagal memasukan data";
    }
    }
    
  }else{
    $error = "Silakan isi semua data";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .mx-auto {width:800px}
    .card {margin-top: 10px}
    </style>

</head>
<body>
  <div class="mx-auto">
    <!--masuyka data -->


  <div class="card">
        <div class="card-header">
          Create / Edit data
        </div>
        <div class="card-body">
        <?php
    if($error){
      ?>
       <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
        </div>
      <?php
    }
    ?>
    <?php
    if($sukses){
      ?>
       <div class="alert alert-success" role="alert">
        <?php echo $sukses ?>
        </div>
      <?php
    }
    ?>
          <form action="" method="post">
          <div class="mb-3 row">
    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="nik" name="nik" value="<?php echo $nik ?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-10">
      <select class="form-control" name="jeniskelamin" id="jeniskelamin">
        <option value="">- Pilih Jenis kelamin -</option>
        <option value="lakilaki" <?php if($jeniskelamin == "lakilaki") echo "selected"?>>Laki laki</option>
        <option value="perempuan" <?php if($jeniskelamin == "perempuan") echo "selected"?>>Perempuan</option>
</select>
  </div>
</div>
  <div class="mb-3 row">
    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="asal" class="col-sm-2 col-form-label">Asal Sekolah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="asal" name="asal" value="<?php echo $asal ?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="nomor" class="col-sm-2 col-form-label">Nomor Hp</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="nomor" name="nomor" value="<?php echo $nomor ?>">
    </div>
  </div>
  <div class="col-12">
    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
  </div>
        </form>
        </div>
      </div>



      <!--mengluarkan data-->

      <div class="card">
        <div class="card-header text-white bg-secondary">
          Data pendaftaran
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama</th>
                <th scope="col">JK</th>
                <th scope="col">Alamat</th>
                <th scope="col">Asal sekolah</th>
                <th scope="col">NO HP</th>
                <th scope="col">Aksi</th>
               </tr>
               <tbody>
                <?php
                $sql2               = "select *from data order by id desc";
                $q2                 = mysqli_query($koneksi,$sql2);
                $urut               = 1;
                while($r2           = mysqli_fetch_array($q2)){
                  $id               = $r2['id'];
                  $nik              = $r2['nik'];
                  $nama             = $r2['nama'];
                  $jeniskelamin     = $r2['jeniskelamin'];
                  $alamat           = $r2['alamat'];
                  $asal             = $r2['asal'];
                  $nomor            = $r2['nomor'];

                  ?>
                  <tr>
                    <th scope="row"><?php echo $urut++ ?></th>
                    <td scope="row"><?php echo $nik ?></td>
                    <td scope="row"><?php echo $nama ?></td>
                    <td scope="row"><?php echo $jeniskelamin ?></td>
                    <td scope="row"><?php echo $alamat ?></td>
                    <td scope="row"><?php echo $asal ?></td>
                    <td scope="row"><?php echo $nomor ?></td>
                    <td scope="row">
                      <a href="index.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                      <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('yakin delete data ?')"><button type="button" class="btn btn-danger">Delete</button></a>
                    
                    </td>
                </tr>
                  <?php
                }
                ?>
            </tbody>
            </thead>
         </table>
        </div>
      </div>
  </div>
</body>
</html>