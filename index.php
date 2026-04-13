<?php 
    include 'koneksi.php';
    $query = "SELECT * FROM siswa;";
    $sql = mysqli_query($connect, $query);
    $no = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>CRUD - Jagat Koding</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-light mb-4 shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">CRUD - PHP MySQL</a>
      </div>
    </nav>

    <div class="container">
        <h1>Data Siswa</h1>
        <figure>
          <blockquote class="blockquote">
            <p>Berisi data yang telah disimpan di database.</p>
          </blockquote>
          <figcaption class="blockquote-footer">
            CRUD <cite title="Source Title">Create Read Update Delete</cite>
          </figcaption>
        </figure>
        
        <a href="kelola.php" type="button" class="btn btn-primary mb-3">
            <i class="fa fa-plus" style="-webkit-text-stroke: 1px white;"></i> Tambah Data
        </a>

        <div class="table-responsive">
            <table class="table align-middle table-bordered table-striped table-hover bg-white">
                <thead>
                    <tr>
                        <th><center>No.</center></th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Foto</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($result = mysqli_fetch_assoc($sql)){ ?>
                    <tr>
                        <td><center><?php echo ++$no; ?>.</center></td>
                        <td><?php echo $result['nisn']; ?></td>
                        <td><?php echo $result['nama']; ?></td>
                        <td><?php echo $result['jenis_kelamin']; ?></td>
                        <td>
                            <center><img src="img/<?php echo $result['foto_siswa']; ?>" style="width: 50px; border-radius: 5px;"></center>
                        </td>
                        <td><?php echo $result['alamat']; ?></td>
                        <td>
                            <a href="kelola.php?ubah=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-success btn-sm">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="proses.php?hapus=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut???')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>