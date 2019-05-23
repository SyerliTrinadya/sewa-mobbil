<script type="text/javascript">
  function Tambah(){
    document.getElementById("action").value="insert";

    document.getElementById("id_mobil").value=" ";
    document.getElementById("nomer_mobil").value=" ";
    document.getElementById("merk").value=" ";
    document.getElementById("jenis").value=" ";
    document.getElementById("warna").value=" ";
    document.getElementById("stok").value = " ";
    document.getElementById("tahun_pembuatan").value=" ";
    document.getElementById("biaya_sewa_per_hari").value=" ";
  }
  function Edit(index){
    document.getElementById("action").value="update";

    var table= document.getElementById("table_mobil");
    var id_mobil=table.rows[index].cells[0].innerHTML;
    var nomer_mobil=table.rows[index].cells[1].innerHTML;
    var merk=table.rows[index].cells[2].innerHTML;
    var jenis=table.rows[index].cells[3].innerHTML;
    var warna=table.rows[index].cells[4].innerHTML;
    var stok = table.rows[index].cells[5].innerHTML;
    var tahun_pembuatan=table.rows[index].cells[6].innerHTML;
    var biaya_sewa_per_hari=table.rows[index].cells[7].innerHTML;

    document.getElementById("id_mobil").value =id_mobil;
    document.getElementById("nomer_mobil").value=nomer_mobil;
    document.getElementById("merk").value=merk;
    document.getElementById("jenis").value=jenis;
    document.getElementById("warna").value=warna;
    document.getElementById("stok").value =stok;
    document.getElementById("tahun_pembuatan").value=tahun_pembuatan;
    document.getElementById("biaya_sewa_per_hari").value=biaya_sewa_per_hari;
  }
</script>
  <div class="card-col-sm-12">
  <div class="card-header bg-info text-white">
      <h4>Daftar Mobil</h4>
    </div>
    <div class="card-body">
      <?php if (isset($_SESSION["message"])) : ?>
        <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
          <?php echo $_SESSION["message"]["message"]; ?>
          <?php unset($_SESSION["message"]); ?>
        </div>
      <?php endif; ?>
      <?php
      $koneksi = mysqli_connect("localhost", "root","", "sewa");
      if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
      }

      $sql ="select * from mobil";
      $result = mysqli_query($koneksi, $sql);
      $count =mysqli_num_rows($result);
       ?>
       <?php if ($count == 0):?>
         <div class="alert alert-info">
            Data is Empty
         </div>
       <?php else: ?>
         <table class="table" id="table_mobil">
           <thead>
             <tr>
               <td>ID Mobil</td>
               <td>Nomer Mobil</td>
               <td>Merk</td>
               <td>Jenis</td>
               <td>Warna</td>
               <td>Stok</td>
               <td>Tahun Pembuatan</td>
               <td>Biaya Sewa(hari)</td>
               <td>Gambar</td>
               <td>Opsi</td>
             </tr>
           </thead>
           <tbody>
             <?php foreach ($result as $hasil):?>
               <tr>
                 <td><?php echo $hasil["id_mobil"];?></td>
                 <td><?php echo $hasil["nomer_mobil"];?></td>
                 <td><?php echo $hasil["merk"];?></td>
                 <td><?php echo $hasil["jenis"];?></td>
                 <td><?php echo $hasil["warna"];?></td>
                 <td><?php echo $hasil["stok"]; ?></td>
                 <td><?php echo $hasil["tahun_pembuatan"];?></td>
                 <td><?php echo $hasil["biaya_sewa_per_hari"];?></td>
                 <td>
                    <img src="<?php echo "img_mobil/".$hasil["gambar"];?>"
                    class="img" width="100">
                  </td>

                 <td>
                   <button type="button" class="btn btn-primary"
                   data-toggle="modal" data-target="#modal"
                   onclick="Edit(this.parentElement.parentElement.rowIndex)">
                    Edit
                 </button>
                 <a href="database_mobil.php?hapus=mobil&id_mobil=<?php echo $hasil["id_mobil"];?>"
                   onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                   <button type="button" class="btn btn-danger">
                     Hapus
                   </button>
                 </a>
                 </td>
               </tr>
           </tbody>
         <?php endforeach;?>
         </table>
       <?php endif;?>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-success"
      data-toggle="modal" data-target="#modal" onclick="Tambah()">
        Tambah Data
    </button>
    </div>
  </div>
</div>

<div class="modal fade" id="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="database_mobil.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4>Form Mobil</h4>
          <span class="close" data-dismiss="modal">&times;</span>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" id="action"/>
          ID Mobil
          <input type="text" name="id_mobil" id="id_mobil" class="form-control">
          Nomer Mobil
          <input type="text" name="nomer_mobil" id="nomer_mobil" class="form-control">
           Merk
          <input type="text" name="merk" id="merk" class="form-control">
          Jenis
          <input type="text" name="jenis" id="jenis" class="form-control">
          Warna
          <input type="text" name="warna" id="warna" class="form-control">
          Stok
          <input type="number" name="stok" id="stok" class="form-control">
          Tahun Pembuatan
         <input type="text" name="tahun_pembuatan" id="tahun_pembuatan" class="form-control">
          Biaya Sewa(hari)
          <input type="text" name="biaya_sewa_per_hari" id="biaya_sewa_per_hari" class="form-control">
          gambar
          <input type="file" name="gambar" id="gambar" class="form-control">

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
