<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <small class="text-strong"> <?php echo $this->session->flashdata('message') ?></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>


            <div class="jumbotron">
                <a href="#" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalrole"><i class="fas fa-plus"></i><span style="margin-left: 10px;">New Role</span></a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($role as $r) : ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $r['role'] ?></td>
                                <td>
                                    <a href="<?php echo base_url('Admin/Roleaccess/') . $r['id'] ?>" class="badge badge-warning">Access</a>
                                    <a href="#" class="badge badge-danger">Delete</a>
                                    <a href="#" class="badge badge-primary">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Menu Modal-->
<div class="modal fade" id="modalrole" tabindex="-1" role="dialog" aria-labelledby="modalrole" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalrole">Add New Role</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo base_url('Admin/Role') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="role" name="role" placeholder="Role name..">
                        <?php echo form_error('role', '<small class="text-muted pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Add New Role</button>
                </div>
            </form>
        </div>
    </div>
</div>