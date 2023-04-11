<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header">
		<div class="row mt-3">
			<div class="col-10">
			<h1 class="h3 mb-2 text-gray-800">Data Produk</h1>
			</div>
			<div class="col-2" style="text-align: center;">
			<h5><a href="<?php echo site_url('produk/add');?>" class="btn btn-primary"> [+ Tambah Data Produk]</a></h5>
			</div>
		</div>    
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>id</th>
						<th width="200">Nama Produk</th>
						<th>Stok</th>
						<th>Berat</th>
						<th>Harga</th>
						<th>Foto</th>
						<th width="750">Deskripsi</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php $i=1; foreach($produk as $item) {?>
				<tbody>
					<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $item['namaProduk'];?></td>
						<td><?php echo $item['stok'];?> Pcs</td>
						<td><?php echo $item['berat'];?> g</td>
						<td>Rp <?php echo number_format($item['harga']);?></td>
						<td><img src="<?php echo base_url('gambar/produk/'.$item['foto'])?>" width="100px" ></td>
						<td><?php echo $item['deskripsi'];?></td>
						<td>                                            
						<a href="<?php echo site_url('produk/getid/'.$item['idProduk']) ?>" class="btn btn-success btn-icon-split">
							<span class="text">Edit</span>
						</a> 
						<Button data-toggle="modal" data-target="#hapus<?= $item['idProduk'] ?>" class="btn btn-danger btn-icon-split">
							<span class="text">Hapus</span>
						</Button>
						</td>
					</tr>
				</tbody>
				<?php }?>
			</table>
		</div>
	</div>
</div>

</div>
<!-- /.container-fluid -->

 <!-- Modal Bukti Pembayaran -->
<?php foreach($produk as $item) {?>
 <div class="modal fade" id="hapus<?= $item['idProduk'] ?>">
        <div class="modal-dialog">
			<div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Produk <?php echo $item['namaProduk'];?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="display-6 mb-0">Apakah anda yakin ingin menghapus data produk ini?</span>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a href="<?php echo site_url('produk/delete/'.$item['idProduk']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<?php } ?>
    <!-- /.modal -->