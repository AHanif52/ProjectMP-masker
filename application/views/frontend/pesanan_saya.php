<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-12 col-md-12 col-lg-12">
<div class="col-sm-12">
    <?php
    if ($this->session->flashdata('pesan')) {
        echo ' <div class="alert alert-dark alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo $this->session->flashdata('pesan');
        echo '</div>';
     }
    if ($this->session->flashdata('error')) {
        echo ' <div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo $this->session->flashdata('error');
        echo '</div>';
    }

    ?>
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-bs-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pesanan Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-bs-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pesanan Diproses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-bs-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Pesanan Dikirim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-bs-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Pesanan Selesai</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($belum_bayar as $key => $value) { ?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td>
                                    <b><?= $value->ekspedisi ?></b><br>
                                    Paket   : <?= $value->paket ?><br>
                                    Estimasi: <?= $value->estimasi ?><br>
                                    Ongkir  : Rp <?= number_format($value->ongkir) ?>
                                </td>

                                <td>Rp <?= number_format($value->total_bayar, 0) ?><br>
                                    <?php if ($value->status_bayar == 0) { ?>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($value->status_bayar == 0) { ?>
                                        <a href="<?= base_url('pesanan_saya/bayar/' . $value->no_order) ?>" class="btn btn-sm btn-flat btn-dark">Bayar</a>
                                    <?php } ?>
                                    <?php if ($value->status_bayar == 0) { ?>
                                    <button class="btn btn-danger btn-sm btn-flat" data-bs-toggle="modal" data-bs-target="#batal<?= $value->no_order ?>">Batalkan</button>
                                    <?php } ?>
                                    <?php if($value->status_bayar == 1) { ?>
                                        <span class="badge bg-primary">Sudah Bayar</span> <br>
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>Keterangan</th>
                        </tr>
                        <?php foreach ($proses as $key => $value) { ?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td>
                                    <b><?= $value->ekspedisi ?></b><br>
                                    Paket : <?= $value->paket ?><br>
                                    Estimasi : <?= $value->estimasi ?><br>
                                    Ongkir : Rp.<?= number_format($value->ongkir) ?>
                                </td>

                                <td>Rp.<?= number_format($value->total_bayar, 0) ?><br>
                                </td>
                                <td>
                                    <span class="badge bg-primary">Pesanan Diproses</span> <br>
                                    <span class="badge bg-warning">Menunggu pihak penjual Mengirim Barang!</span>
                                </td>


                            </tr>
                        <?php } ?>

                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                    <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>No Resi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($kirim as $key => $value) { ?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td>
                                    <b><?= $value->ekspedisi ?></b><br>
                                    Paket : <?= $value->paket ?><br>
                                    Estimasi : <?= $value->estimasi ?><br>
                                    Ongkir : Rp.<?= number_format($value->ongkir) ?>
                                </td>

                                <td>Rp.<?= number_format($value->total_bayar, 0) ?><br></td>
                                <td><?= $value->no_resi ?><br></td>
                                <td>
                                <span class="badge bg-secondary">Dikirim</span>
                                </td>
                                <td>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#diterima<?= $value->no_order ?>">Diterima</button>
                                </td>

                            </tr>
                        <?php } ?>

                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>No Resi</th>
                            <th>Keterangan</th>
                        </tr>
                        <?php foreach ($selesai as $key => $value) { ?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td>
                                    <b><?= $value->ekspedisi ?></b><br>
                                    Paket : <?= $value->paket ?><br>
                                    Estimasi : <?= $value->estimasi ?><br>
                                    Ongkir : Rp.<?= number_format($value->ongkir) ?>
                                </td>

                                <td>Rp.<?= number_format($value->total_bayar, 0) ?><br>
                                <td><?= $value->no_resi ?><br>                                </td>
                                <td> 
                                    <span class="badge bg-primary">Pesanan Selesai</span>
                                </td>


                            </tr>
                        <?php } ?>

                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
</div>
</div>
</div>

<?php foreach ($kirim as $key => $value) { ?>
    <!-- Modal Alert pada tombol diterima -->
    <div class="modal fade" id="diterima<?= $value->no_order ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pesanan Diterima</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                <span class="display-6 mb-0">Apakah pesanan anda sudah diterima?</span>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Belum</button>
                    <a href="<?= base_url('pesanan_saya/diterima/' . $value->no_order) ?>" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<?php foreach ($belum_bayar as $key => $value) { ?>
    <!-- Modal Alert pada tombol diterima -->
    <div class="modal fade" id="batal<?= $value->no_order ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Batalkan Pesanan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <span class="display-6 mb-0">Apakah anda yakin ingin membatalkan pesanan?</span>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('pesanan_saya/batal/' . $value->no_order) ?>" class="btn btn-danger">Batalkan</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>