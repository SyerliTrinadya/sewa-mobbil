<?php
session_start();
  $koneksi = mysqli_connect("localhost", "root", "", "sewa");

  if (isset($_POST["action"])) {
    $id=$_POST["id_mobil"];
    $nomer=$_POST["nomer_mobil"];
    $merk=$_POST["merk"];
    $jenis=$_POST["jenis"];
    $warna=$_POST["warna"];
    $stok=$_POST["stok"];
    $tb=$_POST["tahun_pembuatan"];
    $sewa=$_POST["biaya_sewa_per_hari"];
    $action =$_POST["action"];

    if ($action == "insert") {
      $path = pathinfo($_FILES["gambar"]["name"]);
      $extensi = $path["extension"];
      $filename = $id."-".rand(1,1000).".".$extensi;
   
      $sql = "insert into mobil values
      ('$id', '$nomer', '$merk', '$jenis', '$warna', '$stok','$tb','$sewa','$filename')";
   
      if (mysqli_query($koneksi,$sql)) {
        //jika eksekusi berhasil
        move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_mobil/$filename");
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "berhasil tambah data"
        );
      }else {
        //jika eksekusi gagal
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
      header("location:template.php?page=mobil");
     }else if ($action == "update") {
       if (!empty($_FILES["gambar"]["name"])) {
         // jika gambar diedit
         $sql = "select * from mobil where id_mobil='$id'";
         $result = mysqli_query($koneksi,$sql);
         $hasil = mysqli_fetch_array($result);
         // hapus file lama
         if (file_exists("img_mobil/".$hasil["image"])){
             unlink("img_mobil/".$hasil["image"]);
           }
   
           // membuat nomer_mobil file baru
           $path = pathinfo($_FILES["gambar"]["name"]);
           $extensi = $path["extension"];
           $filename = $id."-".rand(1,1000).".".$extensi;
   
           //membuat perintah update
           $sql = "update mobil set nomer_mobil='$nomer', merk='$merk', jenis='$jenis', warna='$warna',stok= '$stok' ,
           tahun_pembuatan='$tb',biaya_sewa_per_hari = '$sewa',gambar='$filename' where id_mobil='$id'";
           
           if (mysqli_query($koneksi,$sql)) {
             // jika query sukses
             move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_mobil/$filename");
             $_SESSION["message"] = array(
               "type" => "success",
               "message" => "berhasil update data"
             );
           }else {
             // jika query gagal
             $_SESSION["message"] = array(
               "type" => "danger",
               "message" => mysqli_error($koneksi)
             );
           }
   
   
       }else {
         // jika gambar tidak diedit
         $sql = "update mobil set nomer_mobil='$nomer', merk='$merk', jenis='$jenis', warna='$warna',stok= '$stok' ,
         tahun_pembuatan='$tb',biaya_sewa_per_hari = '$sewa' where id_mobil='$id'";
         if (mysqli_query($koneksi,$sql)) {
           // jika query sukses
           $_SESSION["message"] = array(
             "type" => "success",
             "message" => "Data berhasil diupdate"
           );
         }else{
           // jika query gagal
           $_SESSION["message"] = array(
             "type" => "danger",
             "message" => mysqli_error($koneksi)
           );
         }
       }
       header("location:template.php?page=mobil");
     }
   }
   
 
 if(isset($_GET["hapus"])){
   $id = $_GET["id_mobil"];
   // ambil data dari database
   $sql = "select * from mobil where id_mobil='$id'";
   // eksekusi query
   $result = mysqli_query($koneksi,$sql);
   // konversi ke array
   $hasil = mysqli_fetch_array($result);
   if (file_exists("img_mobil/".$hasil["gambar"])) {
     unlink("img_mobil/".$hasil["gambar"]);
     // menghapus file
   }
   $sql = "delete from mobil where id_mobil='$id'";
   mysqli_query($koneksi,$sql);
   header("location:template.php?page=mobil");
 }
  ?>