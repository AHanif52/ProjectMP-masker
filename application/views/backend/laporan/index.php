<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">


            <div class="card-header">
                <h3 class="card-title">Laporan Harian</h3>
            </div>

            <div class="card-body">
                <?php echo form_open('laporan/laporan_harian') ?>
                <div class="row">
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label> Tanggal </label>
                            <select name="tanggal" class="form-control">
                                <?php
                                $start = 1;
                                for ($i = $start; $i < $start + 31; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label> Bulan </label>
                            <select name="bulan" class="form-control">
                                <?php
                                $start = 1;
                                for ($i = $start; $i < $start + 12; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label> Tahun </label>
                            <select name="tahun" class="form-control">
                                <?php
                                $start = date('Y') - 1;
                                for ($i = $start; $i < $start + 5; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Cetak Laporan</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-primary">


            <div class="card-header">
                <h3 class="card-title">Laporan Bulanan</h3>
            </div>

            <div class="card-body">
                <?php echo form_open('laporan/laporan_bulanan') ?>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label> Bulan </label>
                            <select name="bulan" class="form-control">
                                <?php
                                $start = 1;
                                for ($i = $start; $i < $start + 12; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label> Tahun </label>
                            <select name="tahun" class="form-control">
                                <?php
                                $start = date('Y') - 1;
                                for ($i = $start; $i < $start + 5; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Cetak Laporan</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-primary">


            <div class="card-header">
                <h3 class="card-title">Laporan Tahunan</h3>
            </div>

            <div class="card-body">
                <?php echo form_open('laporan/laporan_tahunan') ?>
                <div class="row">

                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label> Tahun </label>
                            <select name="tahun" class="form-control">
                                <?php
                                $start = date('Y') - 1;
                                for ($i = $start; $i < $start + 5; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Cetak Laporan</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>




        </div>
    </div>

</div>
<br>
<div class="card shadow">
    <div class="row">
    <div class="col-12 table-responsive">
    <div class="card-header">    
        <h4 class="ml-2 mt-3">
            <?= date('D, d-M-Y') ?>
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Order</th>
                    <th>Nama Penerima</th>
                    <th>Barang</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Harga Satuan</th>
                    <th>Qty</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $total_keseluruhan = 0;
                foreach ($laporan as $key => $value) {
                    $total_harga = $value->qty * $value->harga;
                    $total_keseluruhan = $total_keseluruhan + $total_harga;
                ?>


                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->no_order ?></td>
                        <td><?= $value->penerima ?></td>
                        <td><?= $value->namaProduk ?></td>
                        <td><?= $value->tgl_order?></td>
                        <td>Rp <?= number_format($value->harga, 0) ?></td>
                        <td><?= $value->qty ?></td>
                        <td>Rp <?= number_format($total_harga, 0) ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
        <h4 class="text-right mr-5 mb-3">
            Total Keseluruhan : Rp <?= number_format($total_keseluruhan, 0) ?>
        </h4>
    </div>
    <!-- /.col -->
</div>
</div>
</div>
