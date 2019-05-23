<div class="container">
  <div class="card col-sm-12">
  <div class="card-header bg-info text-white">
      <h4>Form Peminjaman</h4>
    </div>
    <div class="card-body">
      <?php
      $koneksi = mysqli_connect("localhost","root","","sewa");

      if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
      }

      $sql_pelanggan = "select * from pelanggan where id_pelanggan not in (select id_pelanggan from pinjam where status='Dipinjam')";
      $result_pelanggan = mysqli_query($koneksi,$sql_pelanggan);

      $sql_mobil ="select * from mobil where stok != 0";
      $result_mobil = mysqli_query($koneksi,$sql_mobil);
        ?>

<form action="database_transaksi.php" method="post">
<input type="hidden" name="action" id="action" value="peminjaman">
<div class="form-group col-sm-6">
    <label>Nama Pelanggan</label>
          <select class="form-control" name="pelanggan" required>
            <option value="">Pilih Pelanggan</option>
            <?php
              foreach ($result_pelanggan as $data_pelanggan) {
                echo "
                  <option value='". $data_pelanggan['id_pelanggan'] ."'>". $data_pelanggan['nama_pelanggan'] ."</option>
                ";
              }
            ?>
             </select>
</div>
<div class="form-group col-sm-6">
          <label>Daftar Mobil</label>
          <select multiple class="form-control" name="mobil[]" id="mobil" required>
            <?php
              foreach ($result_mobil as $data_mobil) {
                echo "
                  <option value='". $data_mobil['id_mobil'] ."'>". $data_mobil['nomer_mobil'] ." - ". $data_mobil['merk'] ." (Stok:". $data_mobil['stok'] .")</option>
                ";
              }
            ?>
          </select>
        </div>
        <div class="form-group col-sm-6">
          <label>Jumlah Hari</label>
          <input type="number" class="form-control" name="jumlah_hari">
        </div>
         <div class="form-group col-sm-6">
          <label>Tanggal Pinjam</label>
          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" name="tanggal_pinjam">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
        </div>
        <div class="form-group col-sm-6">
          <label>Tanggal Harus Kembali</label>
          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" name="tanggal_harus_kembali">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
        </div>
        <div class="form-group col-sm-6">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      
    </div>
    <div class="card-footer">
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
  })

</script>