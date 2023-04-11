<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-12 col-md-12 col-lg-12">
            <?php
            if ($this->session->flashdata('error')) {
                echo ' <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo $this->session->flashdata('error');
                echo '</div>';
              }
            ?>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="img-fluid rounded my-4" height="200" width="200" src="<?= base_url('gambar/profil/' . $this->session->userdata('foto')) ?>">
                </div>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                    <dl class="row mt-1 mb-0">
                    <dt class="col-sm-7">Nama Pelanggan</dt>
                    <dd class="col-sm-5" style="text-align:right;"><?= $this->session->userdata('namapelanggan') ?></dd>
                    <dt class="col-sm-7">Username</dt>
                    <dd class="col-sm-5" style="text-align:right;"><?= $this->session->userdata('userName') ?></dd>
                    </dl>
                    </li>
                </ul>
                <div class="row">
                <div class="col-3">
                </div>
                <div class="col-6" style="text-align:center;">
                <a href="<?= base_url('akunmember/edit/' . $this->session->userdata('id')) ?>" class="btn btn-primary btn-block"><b>Ubah Password</b></a>
                </div>
                <div class="col-3">
                </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
</div>
<!-- /.card -->
</div>
    </div>
