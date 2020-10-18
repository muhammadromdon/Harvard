<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <small class="text-strong"> <?php echo $this->session->flashdata('message') ?></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="jumbotron">
                <form action="<?php echo base_url('Users/Changepass') ?>" method="post">
                    <div class="form-group row">
                        <label for="currentpass" class="col-sm-4 col-form-label">Current Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="currentpass" name="currentpass">
                            <?php echo form_error('currentpass', '<small class="text-muted pl-3">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newpass1" class="col-sm-4 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="newpass1" name="newpass1">
                            <?php echo form_error('newpass1', '<small class="text-muted pl-3">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newpass2" class="col-sm-4 col-form-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="newpass2" name="newpass2">
                            <?php echo form_error('newpass2', '<small class="text-muted pl-3">', '</small>') ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" style="margin-top: 10px;">Change Password</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->