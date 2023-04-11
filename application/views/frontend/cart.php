<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-12 col-md-12 col-lg-12">
<div class="card">
    <div class="card-header py-3">
    <?php if ($this->session->flashdata('pesan')) {
        echo ' <div class="alert alert-success alert-dismissible">
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
    <span class="display-6 mb-0">Keranjang</span>
    </div>
    <div class="card-body">
    <section class="section">
    <table class="table table-striped">
    <tr>
        <th>NO</th>
        <th>Nama Produk</th>
        <th>Berat</th>
        <th>Harga</th>
        <th>qty</th>
        <th>Sub Total</th>
        <th>Aksi</th>
    </tr>
    <?php
    $total=0;
    $total_berat= 0;
    $i=1;
    $cart = $this->cart->contents();
    foreach($cart as $val) {
        $produk = $this->M_transaksi->get_produk_by_id($val['id']);
        $total = $total+$val['subtotal'];
        $berat = $val['qty'] * $produk->berat;
        $total_berat = $total_berat + $berat;?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $val['name'];?></td>
            <td><?php echo $berat ;?> gr</td>
            <td><?php echo number_format($val['price']);?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $val["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $val['rowid']; ?>')"></td>
            <td>Rp <?php echo number_format($val['price']*$val['qty']);?></td>
            <td>
                <a href="<?php echo site_url('belanja/delete/'.$val['rowid']); ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
    <?php } ?>
    

    <tr>
        <th></th>
        <td style="text-align: right;">Total Berat :</td>
        <td><?php echo $total_berat; ?> gr</td>
        <th></th>
        <td>Total</td>
        <td>Rp <?php echo number_format($total,0); ?></td>
        <th></th>
    </tr>
    </table>
    </section>
    <div class="row py-3">
        <div class="col-6">
        <a href="<?= base_url('frontend') ?>" class="btn btn-dark"><i class="fa fa-chevron-left"></i>&emsp;Kembali Ke Halaman</a>
        </div>
        <div style="text-align: right;" class="col-6">
            <a href="<?= base_url('belanja/clear') ?>" class="btn btn-danger"> <i class="fas fa-refresh"></i>Clear Cart</a>
            <a href="<?php echo site_url('belanja/cekout'); ?>" class="btn btn-primary">Check Out</a>
        </div>
    </div>
    </div>
</div>
</div>
</div>
</div>

<script>
// Update item quantity
function updateCartItem(obj, rowid){
    $.get("<?php echo base_url('belanja/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
        if(resp == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>