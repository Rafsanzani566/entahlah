<?php
    include 'koneksi.php';

    if(isset($_POST['aksi'])){
        $nisn = $_POST['nisn'];
        $nama = $_POST['nama'];
        $jk   = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];

        if($_POST['aksi'] == "add"){
            $foto = $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);

            $query = "INSERT INTO siswa VALUES(null, '$nisn', '$nama', '$jk', '$foto', '$alamat')";
            mysqli_query($connect, $query);
            header("location: index.php");

        } else if($_POST['aksi'] == "edit"){
            $id = $_POST['id_siswa'];
            $queryShow = "SELECT * FROM siswa WHERE id_siswa = '$id'";
            $sqlShow   = mysqli_query($connect, $queryShow);
            $result    = mysqli_fetch_assoc($sqlShow);

            if($_FILES['foto']['name'] == ""){
                $foto = $result['foto_siswa'];
            } else {
                $foto = $_FILES['foto']['name'];
                @unlink("img/" . $result['foto_siswa']);
                move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
            }

            $query = "UPDATE siswa SET nisn='$nisn', nama='$nama', jenis_kelamin='$jk', alamat='$alamat', foto_siswa='$foto' WHERE id_siswa='$id'";
            mysqli_query($connect, $query);
            header("location: index.php");
        }
    }

    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];
        $queryShow = "SELECT * FROM siswa WHERE id_siswa = '$id'";
        $sqlShow   = mysqli_query($connect, $queryShow);
        $result    = mysqli_fetch_assoc($sqlShow);

        @unlink("img/" . $result['foto_siswa']);
        mysqli_query($connect, "DELETE FROM siswa WHERE id_siswa = '$id'");
        header("location: index.php");
    }
?>