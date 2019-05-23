<?php
session_start();
$koneksi = mysqli_connect("localhost", "root","", "sewa");


  if (isset($_POST["action"])) {
    $id=$_POST["id_pelanggan"];
    $nama=$_POST["nama_pelanggan"];
    $alamat=$_POST["alamat_pelanggan"];
    $kontak=$_POST["kontak"];

    if ($_POST["action"]=="insert") {
       $sql= "insert into pelanggan (id_pelanggan, nama_pelanggan, alamat_pelanggan, kontak) 
        values ('$id','$nama','$alamat','$kontak')";    
      
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
      header("location:template.php?page=pelanggan");
    }
    elseif ($_POST["action"]=="update") {
      $sql="update pelanggan set nama_pelanggan='$nama', alamat_pelanggan='$alamat', kontak='$kontak' where id_pelanggan='$id'";
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
 header("location:template.php?page=pelanggan");
  }

  if (isset($_GET["hapus"])) {
    $id = $_GET["id_pelanggan"];
    $sql = "select * from pelanggan where id_pelanggan='$id'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);

    $sql = "delete from pelanggan where id_pelanggan='$id'";
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
    header("location:template.php?page=pelanggan");
  }
 ?>
