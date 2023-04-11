<!-- Content wrapper -->
<!-- Content -->
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card -->
            <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
       <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">From Edit Pelanggan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php
            //notifikasi_data_tidak_diisi
            echo validation_errors('<div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h7><i class="icon fas fa-info"></i>   ', ' </h7></div>');
            //notifikasi_gagal_upload
            if (isset($error_upload)) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h5><i class="icon fas fa-info"></i>' . $error_upload . '</h5></div>';
            }
            echo form_open_multipart('akunmember/edit/' . $this->session->userdata('id')) ?>

        <div class="row">
            <h5>
                <i class="fas fa-exclamation-triangle text-warning"></i>&nbsp;
                <b>Akun anda akan logout secara otomatis, setelah mengubah data profile
                </b>
            </h5>
        </div>
        <div class="input-group mb-3">
            <input
                type="password"
                class="form-control"
                value="<?= set_value('password') ?>"
                placeholder="Password"
                name="password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input
                type="password"
                class="form-control"
                placeholder="Retype password"
                name="ulangi_password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!-- textarea -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="<?= base_url('akunmember/akun') ?>" class="btn btn-success btn-sm">Kembali</a>
                </div>
            </div>
        </div>

        <?php
            echo form_close();
            ?>
    </div>
</div>
</div>
<div class="col-3">
</div>
</div>
</div>
</div>
</div>
<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_gambar").change(function() {
        bacaGambar(this);
    })
</script>