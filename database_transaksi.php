<?php
$koneksi = mysqli_connect("localhost","root","","sewa");

if (mysqli_connect_errno()) {
  echo mysqli_connect_error();
}

if(isset($_POST["action"])){
    $action = $_POST["action"];

if ($action == "peminjaman") {
    $id_pelanggan = $_POST["pelanggan"];
    $id_mobil = $_POST["mobil"];
    $jumlah_hari = $_POST["jumlah_hari"];
    $tanggal_pinjam = date_format(date_create($_POST["tanggal_pinjam"]), 'Y-m-d');
    $tanggal_harus_kembali = date_format(date_create($_POST["tanggal_harus_kembali"]), 'Y-m-d');

    //insert data pada tabel pinjam
    $insert_pinjam = "insert into pinjam (id_pelanggan, tgl_pinjam, tgl_harus_kembali, jumlah_hari, status)
    values ('$id_pelanggan', '$tanggal_pinjam', '$tanggal_harus_kembali', '$jumlah_hari', 'Dipinjam')";
    ///cek apabila terjadi error
    if (!mysqli_query($koneksi,$insert_pinjam)) {
        echo "Error : " . mysqli_error($koneksi);
        die();
    }
    $last_id_pinjam = mysqli_insert_id($koneksi);
    for($i = 0; $i < sizeof($id_mobil); $i++){
        //insert ke tabel detail_pinjam
         $insert_detail = "insert into detail_pinjam (id_pinjam, id_mobil, jumlah) values ('$last_id_pinjam','". $id_mobil[$i] ."',1)";
         if (!mysqli_query($koneksi,$insert_detail)) {
             echo "Error : " . mysqli_error($koneksi);
             die();
         }
         //pengurangan pada stok mobil
        $update_stok= "update mobil set stok = stok-1 where id_mobil = '". $id_mobil[$i]."'";
        if (!mysqli_query($koneksi,$update_stok)) {
            echo "Error : " . mysqli_error($koneksi);
            die();
        }
    }
    //pengembalian mobil
}else if($action == 'pengembalian'){
    $id_pinjam = $_POST["id_pinjam"];
    $id_mobil = $_POST["id_mobil"];
    $total_pembayaran = $_POST["total_pembayaran"];
    $today = date('Y-m-d');
    //sintak akan berjalan apabila sudah ditekan tombol kembalikan
    $update_status = "update pinjam set status = 'Dikembalikan', tgl_kembali='$today', nominal_pembayaran=$total_pembayaran where id_pinjam ='$id_pinjam'";
    if (!mysqli_query($koneksi,$update_status)) {
        echo "Error : " . mysqli_error($koneksi);
        die();
    }
    //penambahan stok mobil yang sudah dikembalikan
    for ($i = 0; $i < sizeof($id_mobil); $i++){
        $update_stok= "update mobil set stok = stok+1 where id_mobil = '". $id_mobil[$i]."'";
        if (!mysqli_query($koneksi,$update_stok)) {
            echo "Error : " . mysqli_error($koneksi);
            die();
        }  
    }
}
header("location: template.php?page=laporan");
}

?>