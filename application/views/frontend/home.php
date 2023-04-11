<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <!--Carousel-->
    <div class="container-xxl flex-grow-1 container-p">
        <label class="fw-bold display-5 mb-0 py-3">Home</label>
        <?php if ($this->session->flashdata('error')) {
                  echo '<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                  <div class="toast-header"><i class="bx bx-cart me-3"></i>Keranjang
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div>
                  <div class="toast-body">';
                  echo $this->session->flashdata('error');
                  echo '</div> 
                  </div>';
                }?>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            id="carouselExample-cf"
                            class="carousel slide  carousel-dark"
                            data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active"></li>
                                <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1"></li>
                                <li data-bs-target="#carouselExample-cf" data-bs-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img
                                        class="d-block w-100"
                                        src="<?php echo base_url()?>assets/gambar/slide1.jpg"
                                        alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Heading</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img
                                        class="d-block w-100"
                                        src="<?php echo base_url()?>assets/gambar/slide2.jpg"
                                        alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Heading</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img
                                        class="d-block w-100"
                                        src="<?php echo base_url()?>assets/gambar/slide3.jpg"
                                        alt="Third slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Heading</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>
                            <a
                                class="carousel-control-prev"
                                href="#carouselExample-cf"
                                role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a
                                class="carousel-control-next"
                                href="#carouselExample-cf"
                                role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Carousel-->
        <br>
        <!-- Grid Card -->
        <div class="row row-cols-1 row-cols-md-4 g-5 mb-5">
            <?php foreach ($produk as $key => $val) { ?>
            <div class="col">
                <div class="card h-100">
                    <img
                        class="card-img-top"
                        src="<?php echo base_url('gambar/produk/'.$val->foto)?>"
                        alt="Card image cap"/>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $val->namaProduk; ?></h5>
                        <p class="card-text">
                            Stok : <span class="badge badge-center rounded-pill bg-label-primary"><?php echo $val->stok; ?></span>
                        </p>
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                            <a href="#!" class="text-dark fw-bold">Rp <?= number_format($val->harga /*, 2,",","."*/); ?></a>
                            <a href="<?php echo site_url('frontend/detail_produk/'.$val->idProduk)?>"><button  type="button" class="btn btn-primary">Detail Produk</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- / Content -->