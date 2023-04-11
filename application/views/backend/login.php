<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-2 d-none d-lg-block"></div>
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">LOGIN ADMIN</h1>
                                </div>
                                <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                 <h7><i class="icon fas fa-info"></i>   ', ' </h7></div>'); ?>
                                <form
                                    method="POST"
                                    action="<?php echo site_url('login/aksi_login');?>"
                                    class="needs-validation"
                                    novalidate="">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control form-control-user"
                                            id="username"
                                            aria-describedby="emailHelp"
                                            placeholder="Username"
                                            name="username">
                                    </div>
                                    <div class="form-group">
                                        <input
                                            type="password"
                                            class="form-control form-control-user"
                                            id="password"
                                            placeholder="Password"
                                            name="password">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-2 d-none d-lg-block"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>