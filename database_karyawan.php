<?php
session_start();
$koneksi = mysqli_connect("localhost", "root","", "sewa");


  if (isset($_POST["action"])) {
    $id=$_POST["id_karyawan"];
    $nama=$_POST["nama_karyawan"];
    $alamat=$_POST["alamat_karyawan"];
    $kontak=$_POST["kontak"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $level=$_POST["level"];

    if ($_POST["action"]=="insert") {
   $sql ="insert into karyawan values
   ('$id','$nama','$alamat','$kontak','$username','$password','$level')";

      
      if (mysqli_query($koneksi,$sql)) {
        // jika query berhasil
        $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Data has been inserted"
        );
      }
      else{
        //jika query gagal
        $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
        );
      }
      header("location:template.php?page=karyawan");
    }
    elseif ($_POST["action"]=="update") {
      $sql="update karyawan set nama_karyawan='$nama', alamat_karyawan='$alamat', 
      kontak='$kontak', username='$username', password='$password'
      ,level='$level' where id_karyawan='$id'";
      if (mysqli_query($koneksi,$sql)) {
        //buat pesan sukses
        $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Data has been updated"
        );
      }
      else{
        //jika query gagal
        $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
        );
      }
 }
 header("location:template.php?page=karyawan");
  }

  if (isset($_GET["hapus"])) {
    $id = $_GET["id_karyawan"];
    $sql = "select * from karyawan where id_karyawan='$id'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);

    $sql = "delete from karyawan where id_karyawan='$id'";
    if (mysqli_query($koneksi,$sql)) {
      // jika query sukses
      $_SESSION["message"] = array(
      "type" => "success",
      "message" => "Data has been deleted"
      );
    }
    else{
      //jika query gagal
      $_SESSION["message"] = array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=karyawan");
  }
 ?>
