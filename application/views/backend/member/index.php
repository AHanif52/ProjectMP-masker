<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<p class="mb-4">
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header">
		<h1 class="h3 mb-2 text-gray-800">Data Member</h1>
    </div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>id</th>
						<th>Nama Pelanggan</th>
						<th>Password</th>
						<th>Foto Profile</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php $no = 1; foreach($member as $item) {?>
				<tbody>
					<tr>
						<td><?= $no++ ?></td>
						<td><?php echo $item['namapelanggan'];?></td>
						<td><?php echo $item['password'];?> Pcs</td>
						<td><img src="<?php echo base_url('gambar/profil/'.$item['foto'])?>" width="100px" ></td>
						<td><?php if($item['status']=='Y'){ ?> <span class="badge badge-success">Aktif</span>
							<?php } else { ?>
    						<span class="badge badge-danger">Tidak Aktif</span>
      						<?php } ?>
						</td>
						<td><?php if($item['status']=='Y'){ ?>
      						<a href="<?php echo site_url('member/non_aktif/'.$item['idPelanggan']);?>" class="btn btn-warning">Non Aktif</a>
      						<?php } else { ?>
      						<a href="<?php echo site_url('member/aktif/'.$item['idPelanggan']);?>" class="btn btn-primary">Aktif</a>
      						<?php } ?>
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