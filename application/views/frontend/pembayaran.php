<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-12 col-md-12 col-lg-12">
<div class="row">
    <div class="col-sm-6">
    <div class="card card-primary">
            <div class="card-header">
                <span class="display-6 mb-0 card-title">Detail Transaksi</span>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                    </tr>
                    <?php foreach ($produk as $key => $value) { ?>
                        <tr>
                            <td><?= $value->namaProduk ?></td>
                            <td><?= $value->qty ?></td>
                            <td><?= $value->harga ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>Ongkir : <?= number_format($pesanan->ongkir, 0) ?></th>
                        <th>Total</th>
                        <th><?= number_format($pesanan->total_bayar, 0) ?></th>
                    </tr>
                </table>
                <br>
                Silahkan Melakukan Transfer Sesuai Nominal Berikut <span class="text-primary float-end"><b>Rp <?= number_format($pesanan->total_bayar, 0) ?></b></span>
            </div>
        </div>
        <br>
        <div class="card card-primary">
            <div class="card-header">
                <span class="display-6 mb-0 card-title">Rekening Toko</span>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Nama Bank</th>
                        <th>Nomor Rekening</th>
                        <th>Atas Nama</th>
                    </tr>
                    <?php foreach ($rekening as $key => $value) { ?>
                        <tr>
                            <td><?= $value->nama_bank ?></td>
                            <td><?= $value->no_rek ?></td>
                            <td><?= $value->atas_nama ?></td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card card-primary">
            <!-- /.card-header -->
            <div class="card-header p-2" style="text-align: center;">
            <span class="display-6 mb-0 card-title">Form Upload Bukti Pembayaran</span>
            </div>
            <!-- form start -->
            <?= form_open_multipart('pesanan_saya/bayar/' . $pesanan->no_order) ?>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Terang/Atas Nama</label>
                    <input class="form-control" name="atas_nama" placeholder="Atas Nama">
                </div>
                <div class="form-group">
                    <label>Nama Bank</label>
                    <input class="form-control" name="nama_bank" placeholder="Nama Bank">
                </div>
                <div class="form-group">
                    <label>Nomer Rekening</label>
                    <input class="form-control" name="no_rek" placeholder="Nomor Rekening">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Bukti Bayar</label>
                    <input type="file" class="form-control" required name="bukti_bayar" id="bukti_bayar" accept="image/*" id="userfile" onchange="tampilkanPreview(this,'preview')"></input>
                    <img id="preview" width="200px"/>
                    <br>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                    <a href="<?= base_url('pesanan_saya') ?>" class="btn btn-danger">Kembali</a>
                    </div>
                    <div class="col-6" style="text-align: right;">
                    <button type="submit" id="btn_submit" class="btn btn-primary" style="text-align: right;">Kirim</button>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <?= form_close() ?>
        </div>

    </div>
</div>

</div>
    </div>
</div>

<script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{
  var gb = userfile.files;
  for (var i = 0; i < gb.length; i++)
  {
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);
    var reader = new FileReader();
    if (gbPreview.type.match(imageType))
    {
      //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element)
      {
        return function(e)
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      {
        //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }
}
</script>