<!-- Begin Page Content -->
<div class="container-fluid">
<div class="card shadow">
<div class="col-12">
    <div class="invoice p-3 mb-3">


        <!-- title row -->
        <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <i class="fas fa-head-side-mask"></i> Grandezza.id
                    <small class="float-right">Bulan : <?= $bulan ?> Tahun : <?= $tahun ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        </div>
        <!-- info row -->

        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Order</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $grand_total = 0;
                        foreach ($laporan as $key => $value) {
                            $grand_total = $grand_total + $value->sub_total;
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td>Rp.<?= number_format($value->sub_total, 0) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <h4 class="text-right">
                    Total Keseluruhan : Rp.<?= number_format($grand_total, 0)  ?>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row no-print">
            <div class="col-12">
                <a href="invoice-print.html" onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>