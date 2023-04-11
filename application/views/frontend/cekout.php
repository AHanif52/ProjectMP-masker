<!-- Main content -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-12 col-md-12 col-lg-12">
<div class="card">
    <div class="card-header py-3">
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <div class="row">
                    <div class="col-10">
                    <i class="fas fa-head-side-mask"></i> Grandezza.ID
                    </div>
                    <div class="col-2" style="text-align: right;">
                    <small>Date: <?= date('d-M-y') ?></small>
                    </div>
                </div>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    
    <!-- /.row -->
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <h7><i class="icon fas fa-info"></i>   ', ' </h7></div>');
    ?>
    <!-- Table row -->
    <div class="row">

        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                        <th>Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $total_berat = 0;
                    foreach ($this->cart->contents() as $items) {
                        $barang = $this->M_transaksi->get_produk_by_id($items['id']);
                        $berat = $items['qty'] * $barang->berat;
                        $total_berat = $total_berat + $berat;
                    ?>


                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $items['name']; ?></td>
                            <td>
                                <?= $items['qty'] ?>
                            </td>
                            <td style="text-align:left">Rp. <?php echo number_format($items['price'], 0); ?></td>
                            <td style="text-align:left">Rp. <?php echo number_format($items['subtotal'], 0); ?></td>
                            <td style="text-align: left;"><?= $berat ?> Gr</td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <?php
    echo form_open('belanja/cekout');
    $no_order = date('Ymd') . strtoupper(random_string('alnum', 8));
    ?>
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-8">
            <br>
            <b><h5 class="mb-0 py-1">Alamat Pengiriman</h5></b>
            <div class="row">
                <div class="col-sm-6 py-1">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-select" aria-label="Default select example">
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 py-1">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Kota</label>
                        <select name="kota" class="form-select"></select>
                    </div>
                </div>
                <div class="col-sm-6 py-1">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Expedisi</label>
                        <select name="expedisi" class="form-select"></select>
                    </div>
                </div>
                <div class="col-sm-6 py-1">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Paket</label>
                        <select name="paket" class="form-select"></select>
                    </div>
                </div>
                <div class="col-sm-6 py-1">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <input name="nama_penerima" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 py-1">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input name="hp_penerima" class="form-control">
                    </div>
                </div>
                <div class="col-sm-10 py-1">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2 py-1">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input name="kode_pos" class="form-control">
                    </div>
                </div>
            </div>


        </div>
        <!-- /.col -->
        <div class="col-4">


            <div class="table-responsive">
            <br>
            <br>
            <br>
                <table class="table">
                    <tr>
                        <th>No Order</th>
                        <td><?= $no_order ?></td>
                    </tr>
                    <tr>
                        <th style="width:50%">Subtotal</th>
                        <td>Rp. <?php echo number_format($this->cart->total(), 0); ?></td>
                    </tr>
                    <tr>
                        <th>Berat</th>
                        <td> <?= $total_berat ?> Gr</td>
                    </tr>
                    <tr>
                        <th>Ongkir</th>
                        <td>
                            <label id=ongkir></label>
                        </td>
                    </tr>
                    <tr>
                        <th>Total Bayar</th>
                        <td><label id="total_bayar"></label></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Simpan Transaksi -->
    <input name="no_order" value="<?= $no_order ?>" hidden>
    <input name="estimasi" hidden>
    <input name="ongkir" hidden>
    <input name="berat" value="<?= $total_berat ?>" hidden> <br>
    <input name="sub_total" value="<?= $this->cart->total() ?>" hidden>
    <input name="total_bayar" hidden>
    <!-- Akhir Simpan Transaksi -->

    <!-- Simpan Rinci Transaksi -->
    <?php
    $i = 1;
    foreach ($this->cart->contents() as $key => $value) {
        echo
        form_hidden('qty' . $i++, $value['qty']);
    }
    ?>
    <!-- Simpan Rincian Transaksi -->
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-6">
            <a href="<?= base_url('belanja') ?>" class="btn btn-dark"><i class="fa fa-chevron-left"></i>&emsp;Kembali Ke Halaman</a>
        </div>
        <div class="col-6" style="text-align: right;">
            <button type="submit" class="btn btn-success">Check Out&emsp;<i class="fa fa-check-circle"></i>
            </button>
        </div>
    </div>
    <?= form_close() ?>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- /.invoice -->


<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/provinsi') ?>",
            success: function(hasil_provinsi) {
                //console.log(hasil_provinsi);
                $("select[name=provinsi]").html(hasil_provinsi);
            }
        });
    });

    //masukkan data select kota 
    $("select[name=provinsi]").on("change", function() {
        var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/kota') ?>",
            data: 'id_provinsi=' + id_provinsi_terpilih,
            success: function(hasil_kota) {
                $("select[name=kota]").html(hasil_kota);
            }
        });
    });

    $("select[name=kota]").on("change", function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/expedisi') ?>",
            success: function(hasil_expedisi) {
                $("select[name=expedisi]").html(hasil_expedisi);
            }
        });
    });
    $("select[name=expedisi]").on("change", function() {
        //mendapatkan data expedisi terpilih 
        var expedisi_terpilih = $("select[name=expedisi]").val()
        //mendapatkan id kota tujuan terpilih 
        var id_kota_tujuan_terpilih = $("option:selected", "select[name=kota]").attr('id_kota');
        //mendapatkan data total berat 
        var total_berat = <?= $total_berat ?>;

        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/paket') ?>",
            data: 'expedisi=' + expedisi_terpilih + '&id_kota=' + id_kota_tujuan_terpilih + '&berat=' + total_berat,
            success: function(hasil_paket) {
                $("select[name=paket]").html(hasil_paket);
            }
        });
    });

    $("select[name=paket]").on("change", function() {
        //menampilkan data ongkir
        var data_ongkir = $("option:selected", this).attr('ongkir');
        var reverse = data_ongkir.toString().split('').reverse().join(''),
            ribuan_ongkir = reverse.match(/\d{1,3}/g);
        ribuan_ongkir = ribuan_ongkir.join(',').split('').reverse().join('');
        $("#ongkir").html("Rp" + ribuan_ongkir)
        //menampilkan menghitung total transaksi bayar

        var total_bayar = parseInt(data_ongkir) + parseInt(<?= $this->cart->total() ?>);
        var reverse2 = total_bayar.toString().split('').reverse().join(''),
            ribuan_total_bayar = reverse2.match(/\d{1,3}/g);
        ribuan_total_bayar = ribuan_total_bayar.join(',').split('').reverse().join('');

        $("#total_bayar").html("Rp" + ribuan_total_bayar);
        //Hasil estimasi dan ongkir
        var estimasi = $("option:selected", this).attr('estimasi');
        $("input[name=estimasi]").val(estimasi);
        $("input[name=ongkir]").val(data_ongkir);
        $("input[name=total_bayar]").val(total_bayar);
    });
</script>