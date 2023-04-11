<!-- Begin Page Content -->
<div class="container-fluid">
<div class="col-md-12">
    <div class="card card-primary shadow">
        <div class="card-header mt-3">
            <h1 class="h3 mb-2 text-gray-800">Alamat Toko</h1>
        </div>
        <div class="card-body">
            <?php 
             if ($this->session->flashdata('pesan')) {
                echo '   <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> ';
                echo $this->session->flashdata('pesan');
                echo '</h5></div>';
            }
            echo form_open('admin/setting'); ?>


            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-control" required value="<?= $setting->nama_toko ?>">
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" required value="<?= $setting->no_telepon ?>">
                    </div>
                </div>
                <div class="col-sm-12">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Alamat Toko</label>
                        <input type="text" name="alamat_toko" class="form-control" required value="<?= $setting->alamat_toko ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select id="provinsi" name="provinsi" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Kota</label>
                        <select id="kota" name="kota" class="form-control"></select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="<?= base_url('admin') ?>" class="btn btn-success btn-sm">Kembali</a>
                    </div>
                </div>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
            url: "<?php echo base_url('rajaongkir/kota_asal') ?>",
            data: 'id_provinsi=' + id_provinsi_terpilih,
            success: function(hasil_kota) {
                $("select[name=kota]").html(hasil_kota);
            }
        });
    });
</script>