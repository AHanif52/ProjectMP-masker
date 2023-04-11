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
            <div class="card">
            <div class="card-header py-3">
					<div class="bd-highlight mb-3">
						<div class="section-header">
							<div class="section-header-back">
								<a href="<?php echo site_url('frontend');?>" class="btn btn-icon"><i
										class="fas fa-arrow-left"></i></a>
							</div>
                            &emsp;&emsp;<span class="display-6 mb-0">Detail Barang</span>
						</div>
					</div>
				</div>
                <div class="card-body">
                    <article class="product-details container" data-component-product="data-component-product">
                        <div class="row">
                            <!-- gallery and tabs column -->
                            <div class="col-md-5">
                                <div class="zoom-gallery row">
                                    <div class="col-md-12">
                                        <img src="<?php echo base_url('gambar/produk/'.$produk->foto)?>" class="img-fluid" data-image="data-image">
                                    </div>
                                </div>
                            </div>
                            <!-- product name and add to cart -->
                            <div class="col-md-7">
                                <h1 class="product-heading" data-name="data-name"><?php echo $produk->namaProduk?></h1>
                                <!-- product attributes -->
                                    <ul class="list-unstyled text-muted">
                                        <li>Stock: <span><?php echo $produk->stok?></span> </li>
                                    </ul>
                                    <div class="price h3">
                                        <span class="currency" data-currency="data-currency">Rp</span>
                                        <span data-price="data-price"><?php echo number_format($produk->harga /*, 2,",","."*/); ?></span>
                                    </div>
                                    <hr>
                                    <p><?php echo $produk->deskripsi?>.</p>
                                    <hr>
                                    <?php echo form_open('Belanja/add');
                                    echo form_hidden('id', $produk->idProduk);?>
                                <div class="row">
                                    <label class="col-lg-7 display-6 mb-0">Quantity</label>
                                    <div class="col-lg-5">
                                        <input class="form-control" type="number" value="1" name="qty" min="1"/>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary btn-lg float-right col-12"><i class="bx bx-cart"></i> Add to cart </button>
                                <? echo form_close(); ?>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>