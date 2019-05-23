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
        <h4>Laporan Transaksi</h4>
      </div>
      <div class="card-body">
        <?php
        $koneksi = mysqli_connect("localhost","root","","sewa");

        if (mysqli_connect_errno()) {
          echo mysqli_connect_error();
        }

        $sql ="select * from pinjam a join pelanggan b on a.id_pelanggan = b.id_pelanggan";
        $result = mysqli_query($koneksi,$sql);
        $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0): ?>
            <div class="alert alert-info">
              Data is empty
            </div>
          <?php else: ?>
            <table class="table">
              <thead>
                <tr>
                  <th>ID Peminjaman</th>
                  <th>Nama</th>
                  <th>No HP</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Harus Kembali</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 0;
                  foreach ($result as $data_transaksi):
                    $no++;
                ?>
                  <tr>
                    <td><?php echo $data_transaksi["id_pinjam"]; ?></td>
                    <td><?php echo $data_transaksi["nama_pelanggan"]; ?></td>
                    <td><?php echo $data_transaksi["kontak"]; ?></td>
                    <td><?php echo $data_transaksi["tgl_pinjam"]; ?></td>
                    <td><?php echo $data_transaksi["tgl_harus_kembali"]; ?></td>
                    <td><?php echo $data_transaksi["tgl_kembali"]; ?></td>
                    <td><?php echo $data_transaksi["status"]; ?></td>
                    <td>
                      <a href="template.php?page=detail_laporan&id_pinjam=<?php echo $data_transaksi['id_pinjam']; ?>">
                        <button type="button" class="btn btn-primary btn-sm">
                          Detail
                        </button>
                      </a>
                     
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif ?>

      </div>
    </div>
    <button onclick="Print()" type="submit" class="btn btn-success">
      Print
    </button>
  </div>
</div>