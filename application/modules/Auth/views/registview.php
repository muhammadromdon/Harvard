<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="<?php echo base_url() ?>Auth/Registration" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Name" value="<?php echo set_value('name') ?>">
                                <?php echo form_error('name', '<small class="text-muted pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?php echo set_value('email') ?>">
                                <?php echo form_error('email', '<small class="text-muted pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nim" name="nim" placeholder="ID" value="<?php echo set_value('nama') ?>">
                                <?php echo form_error('nim', '<small class="text-muted pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control text-muted" style="border-radius: 40px;" id="jurusan" name="jurusan">
                                    <?php foreach ($jurusan as $j) : ?>
                                        <option value="<?php echo $j ?>"><?php echo $j ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class=" form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?php echo form_error('password1', '<small class="text-muted pl-3">', '</small>') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block mt-5">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?php echo base_url() ?>Auth/Forgotpass">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?php echo base_url() ?>Auth">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>