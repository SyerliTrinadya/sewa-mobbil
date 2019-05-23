<link rel="stylesheet" href="form.css">

<div class="container">
  <div class="card col-sm-12">
    <div class="card-header bg-info text-white">
      <h4>Form Pengembalian</h4>
    </div>
    <div class="card-body">
      <?php
        $koneksi = mysqli_connect("localhost","root","","sewa");

        if (mysqli_connect_errno()) {
          echo mysqli_connect_error();
        }

        $sql = "select * from pelanggan a inner join pinjam b ON a.id_pelanggan = b.id_pelanggan where b.status = 'Dipinjam'";
        $result = mysqli_query($koneksi,$sql);
      ?> 
      
      <?php
        if (!isset($_GET['id_pelanggan'])) {
      ?>
          <div class="form-group col-sm-6">
            <label>Nama Pelanggan</label>
            <select class="form-control" name="pelanggan">
              <option value="">Pilih Pelanggan</option>
              <?php
                foreach ($result as $data_pelanggan) {
                  echo "
                    <option value='". $data_pelanggan['id_pelanggan'] ."'>". $data_pelanggan['nama_pelanggan'] ."</option>
                  ";
                }
              ?>
            </select>
          </div>
          <div class="form-group col-sm-6">
            <a id="link" href=""><button type="button" class="btn btn-primary" onclick="submit()">Submit</button></a>
          </div>
      <?php
        } else {
          $sql_data = "select * from pinjam a join detail_pinjam b on a.id_pinjam = b.id_pinjam join mobil c ON b.id_mobil = c.id_mobil where a.id_pelanggan = ". $_GET['id_pelanggan'] ." ";
          $result_data = mysqli_query($koneksi,$sql_data);
      ?>  
          <h3>Data Peminjaman</h3>
          <br>
          <form action="database_transaksi.php" method="post">
            <input type="hidden" name="action" value="pengembalian" />
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Mobil</th>
                  <th>Nomer Mobil</th>
                  <th>Merk</th>
                  <th>Jumlah Mobil</th>
                  <th>Jumlah Hari</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Harus Kembali</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 0;
                  $grand_total = 0;
                  foreach ($result_data as $data_transaksi):
                    $no++;
                    $grand_total += $data_transaksi["biaya_sewa_per_hari"] * $data_transaksi["jumlah_hari"];
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data_transaksi["id_mobil"]; ?></td>
                    <td>
                      <?php echo $data_transaksi["nomer_mobil"]; ?>
                      <input type="hidden" name="id_pinjam" value="<?php echo $data_transaksi['id_pinjam']; ?>" />
                      <input type="hidden" name="id_mobil[]" value="<?php echo $data_transaksi['id_mobil']; ?>" />
                    </td>
                    <td><?php echo $data_transaksi["merk"]; ?></td>
                    <td><?php echo $data_transaksi["jumlah"]; ?></td>
                    <td><?php echo $data_transaksi["jumlah_hari"]; ?></td>
                    <td><?php echo $data_transaksi["tgl_pinjam"]; ?></td>
                    <td><?php echo $data_transaksi["tgl_harus_kembali"]; ?></td>
                    <td align="right"><?php echo number_format($data_transaksi["biaya_sewa_per_hari"]); ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="8" align="right"><b>Total yang harus dibayarkan</b></td>
                    <td align="right"><b><?php echo number_format($grand_total); ?></b></td>
                </tr>
              </tbody>
            </table>
            <div class="form-group col-sm-3">
                <label class="control-label">Total Pembayaran</label>
                <input type="number" name="total_pembayaran" class="form-control" required/>
            </div>
            <div class="form-group col-sm-6">
              <button type="submit" class="btn btn-success">Kembalikan</button>
            </div>
          </form>
      <?php
        }
      ?>
      
    </div>
    <div class="card-footer">
    </div>
  </div>
</div>

<script type="text/javascript">

  function submit() {
    var id_pelanggan = $('select[name=pelanggan]').val();
    if (id_pelanggan == '') {
      alert('Harap Pilih Pelanggan terlebih dahulu')
    } else {
      $('#link').attr('href','template.php?page=pengembalian&id_pelanggan='+id_pelanggan)
    }
  }

</script>