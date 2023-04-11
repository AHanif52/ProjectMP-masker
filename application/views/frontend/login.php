<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="row">
          <div class="col-4">
          </div>
          <div class="col-4">
          <div class="card">
            <div class="card-body">   
              <h4 class="mb-2">Welcome to Grandezza.ID! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>
              <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h7><i class="icon fas fa-info"></i>   ', ' </h7></div>');
                if ($this->session->flashdata('pesan')) {
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
                echo form_open('akunmember/login'); ?>
                <div class="mb-3">
                  <label for="email" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="username"
                    value="<?php echo set_value('username')?>"
                    placeholder="Enter your username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
                <?php echo form_close() ?>

              <p class="text-center">
                <span>Belum punya akun?</span>
                <a href="<?php echo base_url('akunmember/register')?>">
                  <span>Buat akun/Register</span>
                </a>
              </p>
            </div>
          </div>
          </div>
          <div class="col-4">
          </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>