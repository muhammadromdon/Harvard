<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900">Change password for</h1>
                                    <h5 class="mb-4"><?php echo $this->session->userdata('resetemail') ?></h5>
                                </div>
                                <?php if ($this->session->flashdata('message')) : ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <small class="text-strong"> <?php echo $this->session->flashdata('message') ?></small>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif ?>
                                <form class="user" method="POST" action="<?php echo base_url() ?>Auth/Changepass">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Enter your new password..">
                                        <?php echo form_error('password1', '<small class="text-muted pl-3">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat password..">
                                        <?php echo form_error('password2', '<small class="text-muted pl-3">', '</small>') ?>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Change Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>