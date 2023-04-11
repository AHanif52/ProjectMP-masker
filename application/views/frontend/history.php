<!-- Main content -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-12 col-md-12 col-lg-12">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link " id="custom-tabs-four-settings-tab" data-bs-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Pesanan Selesai</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
    <div class="tab-pane fade show active" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
    <table class="table">
        <tr>
            <th>No Order</th>
            <th>Tanggal</th>
            <th>Expedisi</th>
            <th>Total Bayar</th>
            <th>No Resi</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
        <?php foreach ($selesai as $key => $value) { ?>
        <tr>
            <td><?= $value->no_order ?></td>
            <td><?= $value->tgl_order ?></td>
            <td>
                <b><?= $value->ekspedisi ?></b><br>
                Paket :
                <?= $value->paket ?><br>
                Estimasi :
                <?= $value->estimasi ?><br>
                Ongkir : Rp.<?= number_format($value->ongkir) ?>
            </td>

            <td>Rp.<?= number_format($value->total_bayar, 0) ?><br>
                <td><?= $value->no_resi ?><br>
                </td>
                <td>
                    <span class="badge bg-primary">Pesanan Selesai</span>
                </td>
                <td>
                <button class="btn btn-sm btn-flat btn-dark" data-bs-toggle="modal" data-bs-target="#diterima<?= $value->no_order ?>">Detail Transaksi</button>
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>
    </div>
</div>
        </div>
    </div>
</div>

<?php foreach ($selesai as $key => $value) { ?>
    <!-- Modal Alert pada tombol diterima -->
    <div class="modal fade" id="diterima<?= $value->no_order ?>">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Transaksi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr class="table-info">
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Sub Total</th>
                        </tr>
                        <?php 
                        $this->load->database();
                        $this->load->model('M_transaksi');
                        $id = $value->no_order;
                        $selesai= $this->M_transaksi->selesai_by_id($id);
                        foreach ($selesai as $key => $value) { ?>
                        <tr>
                            <td><?= $value->namaProduk ?></td>
                            <td><?= $value->qty ?></td>
                            <td>Rp <?= number_format($value->harga,0) ?></td>
                            <td>Rp <?= number_format(($value->harga*$value->qty),0) ?></td>
                        </tr>
                        <?php } ?>
                        <tr class="table-info">
                            <td></td>
                            <td></td>
                            <td>Sub Total</td>
                            <td>Rp <?= number_format($value->sub_total, 0) ?></td>
                        </tr>
                        <tr class="table-info">
                            <td></td>
                            <td></td>
                            <td>Ongkir</td>
                            <td>Rp <?= number_format($value->ongkir, 0) ?></td>
                        </tr>
                        <tr class="table-info">
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>Rp <?= number_format($value->total_bayar, 0) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>