<script type="text/javascript">
  function Print(){
    var printDocument = document.getElementById('report').innerHTML;
    // ini adalah bagian yang akan dicetak
    var originalDocument = document.body.innerHTML;

    document.body.innerHTML = printDocument;
    window.print();
    document.body.innerHTML = originalDocument;
  }
</script>
<div class="container">
  <div class="card col-sm-12">
    <div id="report">
      <div class="card-header bg-info text-white">
        <h4>Nota Pembayaran</h4>
      </div>
      <div class="card-body">
        <?php
        $koneksi = mysqli_connect("localhost","root","","sewa");

        if (mysqli_connect_errno()) {
          echo mysqli_connect_error();
        }
        //data diambil dari tabel pinjam dan detail_pinjam
        $sql ="select * from pinjam a join detail_pinjam b on a.id_pinjam = b.id_pinjam join mobil c ON b.id_mobil = c.id_mobil join pelanggan d on a.id_pelanggan = d.id_pelanggan where a.id_pinjam = ". $_GET['id_pinjam'] ." ";
        $result = mysqli_query($koneksi,$sql);
        $count = mysqli_num_rows($result);
        ?>

        <table class="table-default">
          <tbody>
            <?php
              $x = 0;
              foreach ($result as $data) {
                if ($x == 0) {
            ?>
                <tr>
                  <td><strong>ID Peminjaman</strong></td>
                  <td width="20" class="center">:</td>
                  <td><strong><?php echo $data['id_pinjam']; ?></strong></td>
                </tr>
                <tr>
                  <td><strong>Nama</strong></td>
                  <td width="20" class="center">:</td>
                  <td><strong><?php echo $data['nama_pelanggan']; ?></strong></td>
                </tr>
                <tr>
                  <td><strong>Alamat</strong></td>
                  <td width="20" class="center">:</td>
                  <td><strong><?php echo $data['alamat_pelanggan']; ?></strong></td>
                </tr>
                <tr>
                  <td><strong>No HP</strong></td>
                  <td width="20" class="center">:</td>
                  <td><strong><?php echo $data['kontak']; ?></strong></td>
                </tr>
            <?php
                }
                $x++;
              }
            ?>
          </tbody>
        </table>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nomor Mobil</th>
              <th>Merk</th>
              <th>Warna</th>
              <th>Tahun Pembuatan</th>
              <th>Jumlah Mobil</th>
              <th>Jumlah Hari</th>
              <th>Harga (@1 hari)</th>
              <th>Total Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no = 0;
              $grand_total = 0;
              foreach ($result as $data_transaksi):
                $no++;
                $grand_total += $data_transaksi["biaya_sewa_per_hari"] * $data_transaksi["jumlah_hari"]
            ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data_transaksi["nomer_mobil"]; ?></td>
                <td><?php echo $data_transaksi["merk"]; ?></td>
                <td><?php echo $data_transaksi["warna"]; ?></td>
                <td><?php echo $data_transaksi["tahun_pembuatan"]; ?></td>
                <td><?php echo $data_transaksi["jumlah"]; ?></td>
                <td><?php echo $data_transaksi["jumlah_hari"]; ?></td>
                <td align="right"><?php echo number_format($data_transaksi["biaya_sewa_per_hari"]) ?></td>
                <td align="right"><?php echo number_format($grand_total) ?></td>
              </tr>
            <?php endforeach; ?>
                <tr>
                    <td colspan="8" align="right"><b>Grand Total</b></td>
                    <td align="right"><b><?php echo number_format($grand_total); ?></b></td>
                </tr>
          </tbody>
        </table>

      </div>
    </div>
    <button onclick="Print()" type="submit" class="btn btn-success">
      Print
    </button>
  </div>
</div>