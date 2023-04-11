<!-- Content -->
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card -->
            <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-2">Register</h4>
                    <p class="mb-4">Make your app management easy and fun!</p>
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h7><i class="icon fas fa-info"></i>   ', ' </h7></div>');

                echo form_open_multipart('akunmember/register'); ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            value="<?php echo set_value('username')?>"
                            placeholder="Enter your username"
                            autofocus="autofocus"/>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Anda</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama"
                            value="<?php echo set_value('nama')?>"
                            name="nama"
                            placeholder="Masukkan nama anda"/>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"/>
                            <span class="input-group-text cursor-pointer">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label for="password2" class="d-block">Password Confirmation</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password2"
                                class="form-control"
                                name="password_confirm"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"/>
                            <span class="input-group-text cursor-pointer">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Gambar</label>
                                <input
                                    type="file"
                                    name="foto"
                                    class="form-control"
                                    id="userfile"
                                    accept="image/*"
                                    onchange="tampilkanPreview(this,'preview')"
                                    required="required"/>
                            </div>
                        </div>
                        <label for="preview" class="form-label">Preview Gambar</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                              <img src="<?= base_url('assets/gambar/no_photo.png') ?>" id="preview" width="200px"/>
                            </div>
                        </div>
                    </div>
                    <br>
                      <button class="btn btn-primary d-grid w-100">Register</button>          
                    <?php echo form_close() ?>

                    <p class="text-center">
                        <span>Sudah punya akun?</span>
                        <a href="<?php echo site_url('frontend/login')?>">
                            <span>Login sekarang</span>
                        </a>
                    </p>
                </div>
            </div>
            </div>
            <div class="col-3">
            </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
</div>

<!-- / Content -->


<script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{
  var gb = userfile.files;
  for (var i = 0; i < gb.length; i++)
  {
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);
    var reader = new FileReader();
    if (gbPreview.type.match(imageType))
    {
      //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element)
      {
        return function(e)
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      {
        //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }
}
</script>