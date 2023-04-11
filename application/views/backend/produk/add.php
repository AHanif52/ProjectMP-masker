<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    
    <!-- DataTales Example -->
    <div class="card shadow">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Produk</h1>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 hidden-print">
                    <div class="panel-body">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h7><i class="icon fas fa-info"></i>   ', ' </h7></div>'); ?>
                        <form
                            action="<?php echo site_url('produk/save');?>"
                            method="POST"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="isi">Nama Produk</label>
                                            <input
                                                type="text"
                                                name="nama_produk"
                                                class="form-control"
                                                placeholder="Nama Produk">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="isi">Stok</label>
                                            <input type="number" name="stok" min="0" class="form-control" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                Berat (Gr)</label>
                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                name="berat"
                                                id="berat"
                                                placeholder="Berat Barang">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="isi">Harga</label>
                                            <input type="text" name="harga" class="form-control" placeholder="exp 10000">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea
                                                class="form-control"
                                                name="deskripsi"
                                                id="deskripsi"
                                                rows="5"
                                                placeholder="Masukkan Deskripsi"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <img id="preview" width="200px"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a class="btn btn-warning btn-lg" href="<?= base_url('produk') ?>">
                                                <span class="text">Kembali</span>
                                            </a>
                                            <button type="submit" class="btn btn-success btn-lg float-right">
                                                <span class="text">Simpan</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

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